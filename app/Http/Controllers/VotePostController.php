<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Vote;

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

    public function downvote(Post $post)
    {
        Vote::downvote($post);

        return [
            'new_score' => $post->score,
        ];
    }

    public function undoVote(Post $post)
    {
        Vote::undoVote($post);

        return [
            'new_score' => $post->score,
        ];
    }
}
