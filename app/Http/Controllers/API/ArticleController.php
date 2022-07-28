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
    }
}
