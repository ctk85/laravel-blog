<?php

use Illuminate\Database\Seeder;
use App\Category;

use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categories = [
        	'Laravel Tutorials', 
        	'Python Tutorials', 
        	'PHP Tutorials', 
        	'Ruby on Rails Tutorials',
        	'Node Tutorials',
        	'MySQL Tutorials',
            'Django Tutorials',
            'Go Tutorials'
        ];

        foreach($categories as $category) {

        	Category::create([
        		'name' => $category,
                'slug' => str_replace(' ', '-', strtolower($category))
        	]);
        }
    }
}
