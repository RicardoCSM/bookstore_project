<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreAuthorRequest;
use App\Http\Requests\Api\UpdateAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\Filter;
use App\Models\AuthorBook;

class AuthorController extends Controller
{
    protected $author;
    protected $authorBooks;

    public function __construct(Author $author, AuthorBook $authorBook)
    {
        $this->author = $author;
        $this->authorBooks = $authorBook;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Filter $filter): JsonResponse
    {
        $repository = new AuthorRepository($this->author); 

        $authors = $filter->handle($repository, $request, ['books']);

        return response()->json($authors, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request): JsonResponse
    {
        return response()->json($this->author->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $author): JsonResponse
    {
        $author = $this->author->with('books')->find($author);
        if($author === null) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        return response()->json($author, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, int $author): JsonResponse
    {
        $this->author->where('id', $author)->update($request->all());
        $author = $this->author->with('books')->find($author);
        if($author === null) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        return response()->json($author, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $author = $this->author->find($id);
        if($author === null) {
            return response()->json(['message' => 'Author not found'], 404);
        }
        $this->authorBooks->where('author_id', $id)->delete();
        $author->delete();
        return response()->json(['message' => 'Author was removed'], 200);
    }
}
