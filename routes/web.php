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

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/make_order/{book_id}', function ($book_id) {
        return Inertia::render('MakeOrder', ['id' => $book_id]);
    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/add_book', function () {
        return Inertia::render('AdminAdd', ['content' => 1]);
    });

    Route::get('/add_author', function () {
        return Inertia::render('AdminAdd', ['content' => 2]);
    });

    Route::get('/add_publisher', function () {
        return Inertia::render('AdminAdd', ['content' => 3]);
    });

    
    Route::get('/add_book_author/{id}', function ($book_id) {
        return Inertia::render('AdminAdd', ['content' => 4, 'id' => $book_id]);
    });

    
    Route::get('/add_image/{id}', function ($book_id) {
        return Inertia::render('AdminAdd', ['content' => 5, 'id' => $book_id]);
    });

    Route::get('/edit_book/{id}', function ($book_id) {
        return Inertia::render('AdminEdit', ['content' => 1, 'id' => $book_id]);
    });

    Route::get('/edit_author/{id}', function ($author_id) {
        return Inertia::render('AdminEdit', ['content' => 2, 'id' => $author_id]);
    });

    Route::get('/edit_publisher/{id}', function ($publisher_id) {
        return Inertia::render('AdminEdit', ['content' => 3, 'id' => $publisher_id]);
    });
});

require __DIR__.'/auth.php';
