<?php

use App\Http\Controllers\AuthorBookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SanctumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::apiResource('/books', BookController::class);
Route::apiResource('/book_images', BookImageController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/authors', AuthorController::class);
    Route::apiResource('/publishers', PublisherController::class);
    Route::apiResource('/author_books', AuthorBookController::class);
});

Route::post('/login', [SanctumController::class, 'login']);