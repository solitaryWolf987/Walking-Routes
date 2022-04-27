<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
/*
Adds random posts content into table
*/
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = new Post;
        $p1->postTitle = 'title';
        $p1->postContent = 'content here';
        $p1->file_path = "autumnleavesbackground.jpg";
        $p1->user_id = 2;
        $p1->save();
        
        $posts = Post::factory()->count(5)->create();
    }
}
