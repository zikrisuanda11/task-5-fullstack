<?php

use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;


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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('article', [PageController::class, 'article']);
Route::get('category', [PageController::class, 'category']);

Route::get('article-data', [ArticleController::class, 'getArticleData']);
Route::get('article-data/{id}', [ArticleController::class, 'edit']);
Route::post('article', [ArticleController::class, 'store']);
Route::post('article/{id}', [ArticleController::class, 'update']);
Route::delete('article/{id}', [ArticleController::class, 'destroy']);

//category
Route::get('category-data', [CategoryController::class, 'index']);
Route::get('category-data/{id}', [CategoryController::class, 'edit']);
Route::post('category', [CategoryController::class, 'store']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/{id}', [CategoryController::class, 'destroy']);