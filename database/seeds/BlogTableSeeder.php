<?php

use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Blog::insert([
            'image' => 'assets/images/blog-post-01.jpg',
            'title' => 'Best Template Website for HTML CSS',
            'created_at' => \Carbon\Carbon::now(),
            'description' => 'Stand Blog is a free HTML CSS template for your CMS theme. You can easily adapt or customize it for any kind of CMS or website builder. You are allowed to use it for your business. You are NOT allowed to re-distribute the template ZIP file on any template collection site for the download purpose. Contact TemplateMo for more info. Thank you.',
        ]);
        \App\Blog::insert([
            'image' => 'assets/images/blog-post-02.jpg',
            'title' => 'Etiam id diam vitae lorem dictum',
            'created_at' => \Carbon\Carbon::now()->addDay(-1),
            'description' => 'You can support us by contributing a little via PayPal. Please contact TemplateMo via Live Chat or Email. If you have any question or feedback about this template, feel free to talk to us. Also, you may check other CSS templates such as multi-page, resume, video, etc.',
        ]);
        \App\Blog::insert([
            'image' => 'assets/images/blog-post-03.jpg',
            'title' => 'Donec tincidunt leo nec magna',
            'created_at' => \Carbon\Carbon::now()->addDay(-2),
            'description' => 'Nullam at quam ut lacus aliquam tempor vel sed ipsum. Donec pellentesque tincidunt imperdiet. Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc, gravida in erat sit amet, feugiat viverra leo. Phasellus interdum, diam commodo egestas rhoncus, turpis nisi consectetur nibh, in vehicula eros orci vel neque.',
        ]);

    }
}
