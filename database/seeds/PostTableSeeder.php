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
        // Generate an array of the last 20 months
        $months = array_of_months(20,'Y-m-d H:i:s');

        $faker = Faker::create();
        foreach($months as $month) {
        	Post::create([
        		'title' => $faker->name,
        		'description' => $faker->paragraphs(rand(3, 10), true),
        		'user_id' => 1,
                'slug' => $faker->unique->word.'-'.$faker->unique->word,
                'created_at' => $month
        	]);
        }
    }
}
