<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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
    return view('page.home', [
        'top3' => Book::orderBy('download', 'DESC')->paginate(3)
    ]);
});


Route::middleware(['isLogin', 'cekRole:admin'])->group(function () {
    Route::prefix('/dashboard')->group(function () {

        //cateogries
        Route::resource('categories', CategoryController::class);

        //users
        Route::get('users', [UserController::class, 'userindex']);
        Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('/users/userexport', [UserController::class, 'userexport']);
        Route::get('/users/cetakpdf', [UserController::class, 'cetakpdf']);

        //books
        Route::get('/books', [BookController::class, 'index']);
        Route::get('/books/create', [BookController::class, 'create']);
        Route::post('/books/store', [BookController::class, 'store'])->name('book.store');
        Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
        Route::patch('/books/update/{id}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/books/delete/{id}', [BookController::class, 'destroy'])->name('book.delete');
        Route::get('/books/bookexport', [BookController::class, 'bookexport']);
        Route::get('/books/cetakpdf', [BookController::class, 'cetakpdf']);

        
    });
});




Route::middleware(['isLogin', 'cekRole:user,admin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/page', [BookController::class, 'page']);
    Route::get('/read/page', [BookController::class, 'read']);
    Route::get('/page/{id}', [BookController::class, 'show'])->name('page.show');
    Route::get('/plus/{id}', [BookController::class, 'plus'])->name('plus');
    Route::get('/download-pdf/{id}', [BookController::class, 'downloadpdf'])->name('download.pdf');

    Route::get('/book-category/{category:id}', [BookController::class, 'showCategoryBook'])->name('book.category');  
 

});

// Route::get('/page/baca', [BookController::class, 'read'])->name('page.read');


Route::middleware('isGuest')->group(function () {
    
    Route::get('/register', [UserController::class, 'index']);
    Route::post('/register/store', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'login']);
    Route::post('/login/auth', [UserController::class, 'loginAuth'])->name('login.auth');

});

Route::get('/error', function () {
    return view('error');
});

Route::get('/logout', [UserController::class, 'logout']);

