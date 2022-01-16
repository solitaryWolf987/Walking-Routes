<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = new User;
        $user->name = "Admin";
        $user->LastName = "Admin";
        $user->age = "0";
        $user->email = "admin@example.com";
        $user->password = bcrypt('password');
        $user->is_admin = "1";
        $user->save();
        $user1 = new User;
        $user1->name = "example";
        $user1->LastName = "Name";
        $user1->age = "15";
        $user1->email = "example@gmail.com";
        $user1->password = "password1";
        $user1->save();
        

        $users = User::factory()->count(5)->create();
    }
}
