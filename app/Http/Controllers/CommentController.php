<?php

namespace App\Http\Controllers;

use App\{Comment, Post};
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        //todo: Add validation!
        auth()->user()->comment($post, $request->get('comment'));

        return redirect($post->url);
    }
}
