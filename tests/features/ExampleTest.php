<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends FeatureTestCase
{
    use DatabaseTransactions;
    /**
     * @test
     *
     */
    function basic_example()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Jorge El Puto Amo',
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
             ->see('Jorge El Puto Amo');
    }
}
