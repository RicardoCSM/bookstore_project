<?php

namespace App\Http\Controllers;

use App\Actions\Filter;
use App\Http\Requests\Api\StorePublisherRequest;
use App\Http\Requests\Api\UpdatePublisherRequest;
use App\Models\Book;
use App\Models\Publisher;
use App\Repositories\PublisherRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    
    protected $publishers;
    protected $books;

    public function __construct(Publisher $publishers, Book $book)
    {
        $this->publishers = $publishers;
        $this->books = $book;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Filter $filter): JsonResponse
    {
        $repository = new PublisherRepository($this->publishers); 

        $publishers = $filter->handle($repository, $request, ['books']);

        return response()->json($publishers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublisherRequest $request): JsonResponse
    {
        return response()->json($this->publishers->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $publisher): JsonResponse
    {
        $publisher = $this->publishers->with('books')->find($publisher);
        if($publisher === null) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
        return response()->json($publisher, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherRequest $request, int $publisher): JsonResponse
    {
        $this->publishers->where('id', $publisher)->update($request->all());
        $publisher = $this->publishers->with('books')->find($publisher);
        if($publisher === null) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
        return response()->json($publisher, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $publisher = $this->publishers->find($id);
        if($publisher === null) {
            return response()->json(['message' => 'Publisher not found'], 404);
        }
        $this->books->where('publisher_id', $id)->update(['publisher_id' => null]);
        $publisher->delete();
        return response()->json(['message' => 'Publisher was removed'], 200);
    }
}
