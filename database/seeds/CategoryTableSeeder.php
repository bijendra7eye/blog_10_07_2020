<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::insert(['name' => 'Nature Lifestyle']);
        \App\Category::insert(['name' => 'Awesome Layouts']);
        \App\Category::insert(['name' => 'Creative Ideas']);
        \App\Category::insert(['name' => 'Responsive Templates']);
        \App\Category::insert(['name' => 'HTML5 / CSS3 Templates']);
        \App\Category::insert(['name' => 'Creative and Unique']);
    }
}
