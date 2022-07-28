<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends BaseController
{
    public function index()
    {
        $article = Article::all();
        return $this->sendResponse(ArticleResource::collection($article), 'Article fetched');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();

        $article = Article::create($input);

        return $this->sendResponse(new ArticleResource($article), 'Article created');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);

        if (is_null($article)) {
            return $this->sendError('Article not found');
        }

        return $this->sendResponse(new ArticleResource($article), 'Article fetched');
    }

    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();

        // $article = Article::create($input);
        $article->title = $input['title'];
        $article->slug = $input['slug'];
        $article->content = $input['content'];
        $article->save();

        return $this->sendResponse(new ArticleResource($article), 'Article updated');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return $this->sendResponse([], 'Article deleted');
    }
}
