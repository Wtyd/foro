<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * Desactivo la propiedad guarded que da error por MassAssignmentException ya que se que no voy a llamar al metodo Vote::create(Request->all())
     * desde el controlador
     *
     * @var array 
     */
    protected $guarded = [];

    public static function upvote(Post $post)
    {
        static::addVote($post, 1);
    }

    public static function downvote(Post $post)
    {
        static::addVote($post, -1);
    }

    public static function addVote(Post $post, $amount)
    {
        static::updateOrCreate(
            ['post_id' => $post->id, 'user_id' => auth()->id()],
            ['vote' => $amount]
        );

        $post->score = static::where(['post_id' => $post->id])->sum('vote');
        
        $post->save();
    }
}
