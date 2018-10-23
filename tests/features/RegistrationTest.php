<?php

use Illuminate\Support\Facades\Mail;
use App\User;
use App\Token;
use App\Mail\TokenMail;

class RegistrationTest extends FeatureTestCase
{
    public function test_a_user_can_create_an_account()
    {
        Mail::fake();

        $this->visitRoute('register')
        ->type('jorge@styde.net', 'email')
        ->type('Wtyd', 'username')
        ->type('Jorge', 'first_name')
        ->type('Lilao', 'last_name')
        ->press('Regístrate');

        $this->seeInDatabase('users', [
            'email' => 'jorge@styde.net',
            'username' => 'Wtyd',
            'first_name' => 'Jorge',
            'last_name' => 'Lilao',
        ]);

        $user = User::first();

        $this->seeInDatabase('tokens', [
            'user_id' => $user->id
        ]);

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token);
        
        Mail::assertSentTo($user, TokenMail::class, function ($mail) use ($token) {
            return $mail->token->id == $token->id;
        });
        
        $this->seeRouteIs('register_confirmation')
            ->see('Gracias por registrarte')
            ->see('Enviamos a tu email un enlace para que inicies sesión');
    }
}
