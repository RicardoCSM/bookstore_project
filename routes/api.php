<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthorBookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SanctumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

Route::get('/book_images', [BookImageController::class, 'index']);
Route::get('/book_images/{id}', [BookImageController::class, 'show']);
    
Route::middleware('admin')->group(function() {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::patch('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

    Route::post('/book_images', [BookImageController::class, 'store']);
    Route::put('/book_images/{id}', [BookImageController::class, 'update']);
    Route::patch('/book_images/{id}', [BookImageController::class, 'update']);
    Route::delete('/book_images/{id}', [BookImageController::class, 'destroy']);

    Route::apiResource('/authors', AuthorController::class);
    Route::apiResource('/publishers', PublisherController::class);
    Route::apiResource('/author_books', AuthorBookController::class);
});

Route::apiResource('/addresses', AddressController::class);
Route::apiResource('/orders', OrderController::class);

Route::post('/login', [SanctumController::class, 'login'])->name('api.login');