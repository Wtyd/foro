<?php

use Illuminate\Database\Seeder;
use App\{Category, Post};

class PostTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::select('id')->get();
        
        for ($i=0; $i < 100; $i++) {
            factory(Post::class)->create([
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
