<?php

use App\Http\Controllers\ProfileController;
use App\Models\Book;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Index');
})->name('index');

Route::get('/books', function () {
    return Inertia::render('Books');
})->name('books');

Route::get('/orders', function () {
    return Inertia::render('Orders');
})->name('orders');

Route::get('/books/{id}', function ($id) {
    return Inertia::render('Book', ['id' => $id,]);
});

Route::get('/orders/{id}', function ($id) {
    return Inertia::render('Order', ['id' => $id,]);
});

Route::get('/make_order/{book_id}', function ($book_id) {
    return Inertia::render('MakeOrder', ['id' => $book_id]);
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'admin', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
