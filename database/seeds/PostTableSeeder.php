<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Post;

use Faker\Factory as Faker;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,20) as $index) {
        	Post::create([
        		'title' => $faker->sentence,
        		'description' => $faker->paragraph,
        		'author' => 1,
                'created_at' => $faker->date
        	]);
        }
    }
}
