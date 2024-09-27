<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {      

        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);

        /*
        $AdminUser = new User();
        $AdminUser->name = "admin";
        $AdminUser->email = "admin@iesemilidarder.com";
        $AdminUser->role = "superadmin";
        $AdminUser->password = Hash::make('12345678');
        $AdminUser->save();
        */

        User::factory(10)->create();     
        Post::factory(15)->create();
    }
}
