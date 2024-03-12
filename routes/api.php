<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/article', [ArticleController::class, 'getArticles']);

Route::get('/article/{id}', [ArticleController::class, 'getArticle']);

Route::post('/article', [ArticleController::class, 'postArticle']);

Route::put('/article', [ArticleController::class, 'putArticle']);

Route::delete('/article', [ArticleController::class, 'deleteArticle']);
