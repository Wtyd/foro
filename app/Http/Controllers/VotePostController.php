<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post, Vote};
//use App\Vote;

class VotePostController extends Controller
{
    public function upvote(Post $post)
    {
        Vote::upvote($post);

        return [
            'new_score' => $post->score,
        ];
    }
}
