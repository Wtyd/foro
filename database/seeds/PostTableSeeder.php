<?php

use Illuminate\Database\Seeder;
use App\{Category, Post};
use Carbon\Carbon;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::select('id')->get();
        
        for ($i=0; $i < 100; $i++) {
            factory(Post::class)->create([
                'category_id' => $categories->random()->id,
                'created_at' => Carbon::now()->subHours(rand(0, 720)), //Rango de un mes aprox
            ]);
        }
    }
}
