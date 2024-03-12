<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ArticleController extends Controller
{
    //
    public function getArticles(): JsonResponse
    {
        $articles = Article::all();

        return response()->json([
            'article' => $articles,
        ]);
    }

    public function getArticle(string $id): JsonResponse
    {
        $article = Article::all()->where('id', $id);

        return response()->json([
            'article' => $article,
        ]);
    }

    public function postArticle(Request $request): JsonResponse
    {
        $request->validate([
            'title' => ['required'],
            'user_name' => ['required'],
            'user_email' => ['required', 'email'],
            'content' => ['required'],
        ]);

        $input = $request->only(['title', 'user_name', 'user_email', 'content']);

        $article = new Article();
        $article->title = $input['title'];
        $article->user_name = $input['user_name'];
        $article->user_email = $input['user_email'];
        $article->content = $input['content'];

        $article->save();

        return response()->json([
            'message' => '新增成功',
        ], ResponseAlias::HTTP_CREATED);
    }

    public function putArticle(Request $request): JsonResponse
    {
        $request->validate([
            'id' => ['required'],
            'title' => ['required'],
            'user_name' => ['required'],
            'user_email' => ['required', 'email'],
            'content' => ['required'],
        ]);
        $input = $request->only(['id', 'title', 'user_name', 'user_email', 'content']);

        $article = Article::find($input['id']);

        $article->title = $input['title'];
        $article->user_name = $input['user_name'];
        $article->user_email = $input['user_email'];
        $article->content = $input['content'];

        $article->update();

        return response()->json([
            'message' => '更改成功',
        ], ResponseAlias::HTTP_OK);
    }

    public function deleteArticle(Request $request): JsonResponse
    {
        $request->validate([
            'id' => ['required'],
        ]);
        $input = $request->only(['id']);
        $article = Article::find($input['id']);
        $article->delete();

        return response()->json([
            'message' => '刪除成功',
        ], ResponseAlias::HTTP_OK);
    }
}
