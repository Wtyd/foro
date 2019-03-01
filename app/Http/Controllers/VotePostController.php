<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post, VoteRepository};

//use App\Vote;

class VotePostController extends Controller
{
    protected $voteRepository;

    public function __construct(VoteRepository $voteRepository)
    {
        $this->voteRepository = $voteRepository;
    }

    public function upvote(Post $post)
    {
        $post->upvote($post);

        return [
            'new_score' => $post->score,
        ];
    }

    public function downvote(Post $post)
    {
        $post->downvote($post);

        return [
            'new_score' => $post->score,
        ];
    }

    public function undoVote(Post $post)
    {
        $post->undoVote($post);

        return [
            'new_score' => $post->score,
        ];
    }
}
