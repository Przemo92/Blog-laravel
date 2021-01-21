<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }
}
