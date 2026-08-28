<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{
    /**
     * Display the blog page with all posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('rpro.blog');
    }

    /**
     * Display a specific blog post.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Load all the data via API
        $url = config('app.url') . '/api/blog/' . $slug;
        $data = Http::get($url);

        return view('rpro.blog_post', compact('data'));
    }
} 