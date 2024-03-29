<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($slug): string
    {
        $post = \DB::table('posts')->where('slug', $slug)->first();
        return view('post', [
            'post' => $post->body ?? 'Nothing here yet.'
        ]);
    }
}
