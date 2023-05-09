<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreBookRequest;
use App\Http\Requests\Api\UpdateBookRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\Filter;
use App\Models\AuthorBook;
use App\Models\BookImage;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    protected $book;
    protected $authorBooks;
    protected $bookImages;

    public function __construct(Book $book, AuthorBook $authorBooks, BookImage $bookImages)
    {
        $this->book = $book;
        $this->authorBooks = $authorBooks;
        $this->bookImages = $bookImages;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Filter $filter): JsonResponse
    {
        $repository = new BookRepository($this->book); 

        $books = $filter->handle($repository, $request, ['publisher', 'authors', 'images']);
        
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        return response()->json($this->book->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $book): JsonResponse
    {
        $book = $this->book->with('publisher', 'authors', 'images')->find($book);
        if($book === null) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, int $book): JsonResponse
    {
        $this->book->where('id', $book)->update($request->all());
        $book = $this->book->with('publisher', 'authors')->find($book);
        if($book === null) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $book = $this->book->find($id);
        if($book === null) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        $this->authorBooks->where('book_id', $id)->delete();
        $bookImages = $this->bookImages->where('book_id', $id)->get();

        foreach($bookImages as $book_image) {
            Storage::disk('public')->delete($book_image->image);
            $book_image->delete();
        }

        $book->delete();
        return response()->json(['message' => 'Book was removed'], 200);
    }
}
