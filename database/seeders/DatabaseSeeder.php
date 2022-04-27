<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


/*
Allows data to be seeded into the database
*/
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
