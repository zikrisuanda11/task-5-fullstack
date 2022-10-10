<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\API\V1\ArticleController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\Auth\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(tapi'auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('article', [ArticleController::class, 'index']);
});

Route::post('article', [ArticleController::class, 'store']);
Route::get('article/{id}', [ArticleController::class, 'show']);
Route::put('article/{id}', [ArticleController::class, 'update']);
Route::delete('article/{id}', [ArticleController::class, 'destroy']);

Route::get('category', [CategoryController::class, 'index']);
Route::post('category', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/{id}', [CategoryController::class, 'destroy']);

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

