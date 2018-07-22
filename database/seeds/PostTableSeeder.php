<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 
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
        foreach(range(1,30) as $index) {
        	DB::table('posts')->insert([
        		'title' => $faker->name,
        		'description' => $faker->paragraph,
        		'author' => 1,
                'created_at' => date('Y-m-d H:i:s')
        	]);
        }
    }
}
