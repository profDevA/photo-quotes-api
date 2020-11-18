<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('admin');
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');

Route::resource('quotes', App\Http\Controllers\QuoteController::class);

Route::resource('articles', App\Http\Controllers\ArticleController::class);

Route::resource('sources', App\Http\Controllers\SourceController::class);

Route::resource('category', App\Http\Controllers\CategoryController::class);

Route::resource('articleTypes', App\Http\Controllers\ArticleTypeController::class);

Route::resource('books', App\Http\Controllers\BookController::class);

Route::resource('tags', App\Http\Controllers\TagController::class);
