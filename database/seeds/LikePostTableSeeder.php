<?php

use Illuminate\Database\Seeder;
use App\LikePost;

class LikePostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        foreach(range(1,1000) as $index) {
        	LikePost::firstOrCreate([
        		'user_id' => rand(1,30),
        		'post_id' => rand(1,30)
        	]);
        }
    }
}
