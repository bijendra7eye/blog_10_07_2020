<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => Hash::make("123456")]);
    }
}
