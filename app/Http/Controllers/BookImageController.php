<?php

namespace App\Http\Controllers;

use App\Models\BookImage;
use App\Repositories\BookImageRepository;
use Illuminate\Http\Request;
use App\Actions\Filter;
use Illuminate\Support\Facades\Storage;

class BookImageController extends Controller
{
    protected $book_images;

    public function __construct(BookImage $book_images)
    {
        $this->book_images = $book_images;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Filter $filter)
    {
        $repository = new BookImageRepository($this->book_images); 

        $book_images = $filter->handle($repository, $request, ['books']);

        return response()->json($book_images, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $image_urn = $image->store('images/books', 'public');
        $book_images = $this->book_images->create([
            'book_id' => $request->book_id,
            'image' => $image_urn
        ]);

        return response()->json($book_images, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $book_image)
    {
        $book_image = $this->book_images->with('publisher', 'authors', 'images')->find($book_image);
        if($book_image === null) {
            return response()->json(['message' => 'Book image not found'], 404);
        }
        return response()->json($book_image, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $book_image = $this->book_images->find($id);

        if($book_image === null) {
            return response()->json(['message' => 'Book image not found'], 404);
        }

        $image = $request->file('imagem');
        $image_urn = $image->store('images/books', 'public');

        if($image) {
            Storage::disk('public')->delete($book_image->image);
        }

        $book_image->fill($request->all());
        $book_image->image = $image_urn;
        $book_image->save();

        return response()->json($book_image, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book_image = $this->book_images->find($id);

        if($book_image === null) {
            return response()->json(['message' => 'Book image not found'], 404);
        }

        Storage::disk('public')->delete($book_image->image);

        $book_image->delete();
        return response()->json(['message' => 'Book image was removed'], 200);
    }
}