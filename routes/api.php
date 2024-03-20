<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

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

Route::get('/articles', [ArticleController::class, 'getArticles']);

Route::get('/articles/{id}', [ArticleController::class, 'getArticle']);

Route::post('/articles', [ArticleController::class, 'postArticle']);

Route::put('/articles', [ArticleController::class, 'putArticle']);

Route::delete('/articles', [ArticleController::class, 'deleteArticle']);

Route::post('/images', [FileController::class, 'postFile']);

