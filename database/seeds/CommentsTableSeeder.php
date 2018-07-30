<?php

use Illuminate\Database\Seeder;
use App\Comment;

use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
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
        	Comment::create([
        		'user_id' => $index,
        		'body' => $faker->paragraph,
        		'post_id' => $index
        	]);
        }
    }
}
