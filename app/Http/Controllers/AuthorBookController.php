<?php

namespace App\Http\Controllers;

use App\Actions\Filter;
use App\Http\Requests\Api\StoreAuthorBookRequest;
use App\Http\Requests\Api\UpdateAuthorBookRequest;
use App\Models\AuthorBook;
use App\Repositories\AuthorBookRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorBookController extends Controller
{

    protected $author_books;

    public function __construct(AuthorBook $author_books)
    {
        $this->author_books = $author_books;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Filter $filter) : JsonResponse
    {
        $repository = new AuthorBookRepository($this->author_books); 

        $author_books = $filter->handle($repository, $request, ['book', 'author']);

        return response()->json($author_books, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorBookRequest $request): JsonResponse
    {
        return response()->json($this->author_books->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $author_books = $this->author_books->find($id);
        if($author_books === null) {
            return response()->json(['message' => 'Relationship not found'], 404);
        }
        return response()->json($author_books, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorBookRequest $request, int $id): JsonResponse
    {
        $this->author_books->where('id', $id)->update($request->all());
        $author_books = $this->author_books->with('book', 'author')->find($id);
        if($author_books === null) {
            return response()->json(['message' => 'Relationship not found'], 404);
        }
        return response()->json($author_books, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $author_books = $this->author_books->find($id);
        if($author_books === null) {
            return response()->json(['message' => 'Relationship not found'], 404);
        }
        $author_books->delete();
        return response()->json(['message' => 'Relationship was removed'], 200);
    }
}
