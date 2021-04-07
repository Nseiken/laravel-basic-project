<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function posts()
    {
        $posts = Post::with('user')->latest()->paginate();

        return view('posts', compact('posts'));
    }

    public function post(Post $post)
    {
        return view('post', compact('post'));
    }
}
