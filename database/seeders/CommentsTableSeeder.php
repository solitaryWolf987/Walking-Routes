<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

/*
Adds random comments content into table
*/
class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c1 = new Comment;
        $c1->commentContent = 'content here';
        $c1->user_id = 2;
        $c1->post_id = 2;
        $c1->save();
        
       $comments = Comment::factory()->count(5)->create();
    }
}
