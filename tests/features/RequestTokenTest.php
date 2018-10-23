<?php

use Illuminate\Support\Facades\Mail;
use App\Token;

class RequestTokenTest extends FeatureTestCase
{
    function test_a_guest_user_can_request_a_token()
    {
        //Having
        Mail::fake();

        $user = $this->defaultUser(['email' => 'jorgelilaoc@gmail.com']);

        //When
        $this->visitRoute('token')
            ->type('jorgelilaoc@gmail.com', 'email')
            ->press('Solicitar token');

        //Then: a new token is created in the database
        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token, 'A token was not created');

        //And sent to the user
        Mail::assertSentTo($user, \App\Mail\TokenMail::class, function ($mail) use ($token) {
            return $mail->token->id === $token->id;
        });

        $this->dontSeeIsAuthenticated();

        $this->see('Enviamos a tu email un enlace para que inicies sesión');
    }

    function test_a_guest_user_can_request_a_token_without_an_email()
    {
        //Having
        Mail::fake();

        //When
        $this->visitRoute('token')
            ->press('Solicitar token');

        //Then: a new token is NOT created in the database
        $token = Token::first();

        $this->assertNull($token, 'A token was created');

        //And sent to the user
        Mail::assertNotSent(\App\Mail\TokenMail::class);

        $this->dontSeeIsAuthenticated();

        $this->seeErrors([
            'email' => 'El campo correo electrónico es obligatorio'
        ]);
    }

    function test_a_guest_user_can_request_a_token_an_invalid_email()
    {
        //When
        $this->visitRoute('token')
            ->type('Jorge', 'email')
            ->press('Solicitar token');

        $this->seeErrors([
            'email' => 'Correo electrónico no es un correo válido'
        ]);
    }

    function test_a_guest_user_can_request_a_token_a_non_existent_email()
    {
        $this->defaultUser(['email' => 'jorgelilaoc@gmail.com']);

        //When
        $this->visitRoute('token')
            ->type('uncorreoquenoexisteenlabd@email.com', 'email')
            ->press('Solicitar token');

        $this->seeErrors([
            'email' => 'Este correo electrónico no existe'
        ]);
    }
}
