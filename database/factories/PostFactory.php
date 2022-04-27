<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/*
Creates random posts content for testing
*/
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'postTitle' => $this->faker->firstName(),
            'postContent' => $this->faker->firstName(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
