<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GearController;
use App\Http\Controllers\GearCommentController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(PostController::class)->group(function(){
    Route::get('/', 'index')->name('posts.index');
    Route::get('/posts/search', 'searchIndex')->name('posts.search');
    Route::post('/posts', 'store')->middleware('auth');
    Route::get('/posts/create', 'create')->name('posts.create')->middleware('auth');
    Route::get('/posts/{post}', 'show');
    Route::get('/posts/{post}/edit', 'edit')->middleware('auth');
    Route::put('/posts/{post}', 'update')->middleware('auth');
    Route::delete('/posts/{post}', 'delete')->middleware('auth')->name('delete');
});

Route::get('/categories/{category}', [CategoryController::class, 'index']);

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'delete'])->middleware('auth');

Route::post('/gear_comments', [GearCommentController::class, 'store'])->middleware('auth');
Route::delete('/gear_comments/{comment}', [GearCommentController::class, 'delete'])->middleware('auth');

Route::controller(GearController::class)->group(function(){
    Route::get('/gears/index', 'index')->name('gears.index');
    Route::get('/gears/create', 'create')->name('gears.create')->middleware('auth');
    Route::post('/gears/store', 'store')->name('gears.store')->middleware('auth');
    Route::get('/gears/{gear}', 'show')->name('gears.show');
    Route::get('/gears/{gear}/edit', 'edit')->name('gears.edit')->middleware('auth');
    Route::put('/gears/{gear}', 'update')->middleware('auth');
    Route::delete('/gears/{gear}', 'delete')->name('delete')->middleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
