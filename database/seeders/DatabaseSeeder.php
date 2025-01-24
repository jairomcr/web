<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //Deleted the directory
        //Storage::deleteDirectory('posts');

        //This is to create a directory, where the images are saved 
        //Storage::makeDirectory('posts');


        //Running the seeders
        $this->call(UserSeeder::class);
        Category::factory(4)->create();
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);
    }
}
