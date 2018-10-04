<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $user = $this->defaultUser();

        $post = factory(Post::class)->make([
            'title' => 'Como instalar Laravel'
        ]);

        $user->posts()->save($post);

        $post->save();
        
        /*
        Las 3 formas de comprobar que el post se ha guardado son correctas.

        1. 
        $this->seeInDatabase('post', [
            'slug' => 'como-instalar-laravel'
        ]);

        2. Al hacer save del post, si hubiera algun error el test fallaria
        $this->assertSame('como-instalar-laravel', $post->slug);
        */

        //Fresh recarga de la BD el modelo. Es decir, vuelve a pedir a la BD los datos del post.
        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug);
    }
}
