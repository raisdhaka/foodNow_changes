<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Blog\Http\Controllers\Main as BlogMainController;

class BlogController extends Controller
{
    protected $blogController;

    public function __construct()
    {
        $this->blogController = new BlogMainController();
    }

    /**
     * Display a listing of blog posts
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->blogController->all($request);
    }

    /**
     * Display a specific blog post by slug
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slug)
    {
        return $this->blogController->single($slug);
    }
} 