<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::controller(PostController::class)->group(function(){
    Route::get('/', 'index')->name('posts.index');
    Route::get('/posts/search', 'searchIndex')->name('posts.search');
    Route::post('/posts', 'store');
    Route::get('/posts/create', 'create');
    Route::get('/posts/{post}', 'show');
    Route::get('/posts/{post}/edit', 'edit');
    Route::put('/posts/{post}', 'update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
});

Route::get('/categories/{category}', [CategoryController::class, 'index']);