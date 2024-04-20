<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test/vue', function () {
    return view('test.vue');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




//allbooks
Route::get('books', [BookController::class, 'index'])->name('books.index');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //////

    Route::get('/profile/{user}', [UserController::class, 'showProfile'])->name('user.profile');


    // edit
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edituser');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('updateuser');

    //delete
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('deleteuser');

    //change password
    Route::get('/users/password/change', [UserController::class, 'showPasswordChangeForm'])->name('password.change');
    Route::post('/users/password/change', [UserController::class, 'changePassword'])->name('password.update');

    //Ayman
    //Route::get('about', function () { return view('books.about');})->name('about');
    Route::get('/about', [BookController::class, 'about'])->name('about');

    //Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store',[BookController::class, 'store'])->name('storebook');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/comments', [BookController::class, 'storeComment'])->name('books.comments.store');
    Route::get('books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('books/delete/{id}',[BookController::class, 'delete'])->name('books.delete');
    Route::get('/books/{book}/{action}', [BookController::class, 'action'])->name('books.action');
    Route::get('/update-hidden/{id}', [UserController::class, 'updateCheckbox'])->name('user.update.hidden');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    //all the users  
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    //comment shit
    Route::delete('users/comments/{id}', [UserController::class, 'deleteComment'])->name('user.comments.delete');

    // this shit just for the ng admin, if you are not, go to the hell
    Route::get('/admin/books', [AdminController::class, 'index'])->name('admin.books.index');
    Route::post('admin/books/delete/{id}',[AdminController::class, 'delete'])->name('admin.books.delete');
    Route::get('/update-approved/{id}', [AdminController::class, 'updateCheckbox'])->name('admin.update.approved');
    Route::get('/update-role/{id}', [AdminController::class, 'updateCheckboxRole'])->name('admin.update.role');    

    
    Route::get('/admin/books/{id}', [AdminController::class, 'show'])->name('admin.books.show');
    Route::get('/admin/profile/{user}', [AdminController::class, 'showProfile'])->name('admin.user.profile');
    Route::Delete('/admin/comments/{id}', [AdminController::class, 'deleteComment'])->name('admin.comments.delete');
    Route::Delete('/admin/user/{id}', [AdminController::class, 'delete_user'])->name('admin.user.delete');
    Route::get('/admin/users', [AdminController::class, 'index_users'])->name('admin.users.index');
});






require __DIR__.'/auth.php';
