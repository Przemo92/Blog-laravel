<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        //$posts = Post::whereNotNull('published_at')->where('published_at', '<=', Carbon::now())->get();
        $posts = Post::published()->get();

        return view('posts.index')->with('posts', $posts);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }
    public function store(Request $request)
    {
        $request->user()->posts()->create($request->only([
            'published_at',
            'title',
            'body',
        ]));
    }
}
