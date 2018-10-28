<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'first_name' => 'Jorge',
            'last_name' => 'Lilao',
            'username' => 'Wtyd',
            'email' => 'jorgelilaoc@email.com',
        ]);
    }
}
