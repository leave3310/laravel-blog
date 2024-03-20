<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostArticlesRequest;
use App\Http\Requests\PutArticlesRequest;
use App\Http\Resources\Article\ArticleCollection;
use App\Models\Article;

use App\Utilities\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use App\Http\Resources\Article\ArticleResource;

class ArticleController extends Controller
{
    use ApiResponseTrait;

    public function getArticles(): JsonResponse
    {
        $articles = Article::all();

        return $this->successResponse(new ArticleCollection(ArticleResource::collection($articles)), "新增文章成功", ResponseAlias::HTTP_OK);
    }

    public function getArticle(string $id): JsonResponse
    {

        $article = Article::where('id', $id)->get()->toArray();

        if (empty($article)) {
            return $this->errorResponse([], "找不到對應文章", ResponseAlias::HTTP_NOT_FOUND);
        } else {
            return $this->successResponse([
                'article' => $article,
            ], "找到文章", ResponseAlias::HTTP_OK);
        }

    }

    public function postArticle(PostArticlesRequest $request): JsonResponse
    {

        $input = $request->only(['title', 'user_name', 'user_email', 'content']);
        $article = new Article();
        $article->title = $input['title'];
        $article->user_name = $input['user_name'];
        $article->user_email = $input['user_email'];
        $article->content = $input['content'];

        $article->save();

        return $this->successResponse([], "新增成功", ResponseAlias::HTTP_CREATED);
    }

    public function putArticle(PutArticlesRequest $request): JsonResponse
    {

        $input = $request->only(['id', 'title', 'user_name', 'user_email', 'content']);

        $article = Article::find($input['id']);

        $article->title = $input['title'];
        $article->user_name = $input['user_name'];
        $article->user_email = $input['user_email'];
        $article->content = $input['content'];

        $article->update();

        return $this->successResponse([], '更改成功', ResponseAlias::HTTP_OK);
    }

    public function deleteArticle(Request $request): JsonResponse
    {
        $request->validate([
            'id' => ['required'],
        ]);
        $input = $request->only(['id']);
        $article = Article::find($input['id']);
        $article->delete();

        return $this->successResponse([], "刪除成功", ResponseAlias::HTTP_OK);
    }
}
