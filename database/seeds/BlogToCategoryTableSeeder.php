<?php

use Illuminate\Database\Seeder;

class BlogToCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BlogToCategory::insert(['blog_id' => 1, 'category_id' => 1]);
        \App\BlogToCategory::insert(['blog_id' => 1, 'category_id' => 2]);

        \App\BlogToCategory::insert(['blog_id' => 2, 'category_id' => 3]);
        \App\BlogToCategory::insert(['blog_id' => 2, 'category_id' => 4]);

        \App\BlogToCategory::insert(['blog_id' => 3, 'category_id' => 5]);
        \App\BlogToCategory::insert(['blog_id' => 3, 'category_id' => 6]);
    }
}
