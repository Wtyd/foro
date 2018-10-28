<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::forceCreate([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);

        Category::forceCreate([
            'name' => 'Javascript',
            'slug' => 'javascript',
        ]);

        Category::forceCreate([
            'name' => 'Vue.js',
            'slug' => 'vue-js',
        ]);

        Category::forceCreate([
            'name' => 'Css',
            'slug' => 'css',
        ]);

        Category::forceCreate([
            'name' => 'Sass',
            'slug' => 'sass',
        ]);

        Category::forceCreate([
            'name' => 'Git',
            'slug' => 'git',
        ]);

        Category::forceCreate([
            'name' => 'Otras tecnologías',
            'slug' => 'otras-tecnologias',
        ]);
    }
}
