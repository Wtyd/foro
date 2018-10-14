<?php

namespace App\Policies;

use App\{Comment, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{

    public function accept(User $user, Comment $comment)
    {
        return $user->owns($comment->post);
    }
}
