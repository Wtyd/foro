<?php

use App\Mail\TokenMail;
use App\{Token, User};
use Illuminate\Support\Facades\Mail;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Mail\Mailable;

class TokenMailTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_sends_a_link_with_the_token()
    {
        $user = new User([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
            'email' => 'duilio@styde.net',
        ]);

        $token = new Token([
            'token' => 'this-is-a-token',
            'user' => $user,
        ]);

        $this->open(new TokenMail($token));

        $this->seeLink($token->url, $token->url);
    }

    protected function open(Mailable $mailable)
    {
        $transport = Mail::getSwiftMailer()->getTransport();

        $transport->flush();

        Mail::send($mailable);

        $message = $transport->messages()->first();

        $this->crawler = new Crawler($message->getBody());

        return $this;
    }
}
