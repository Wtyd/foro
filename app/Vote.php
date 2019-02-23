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
        static::create(
            [
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'vote' => 1,
            ]
        );

        $post->score = 1;
        
        $post->save();
    }
}
