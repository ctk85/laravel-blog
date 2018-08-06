<?php

use Illuminate\Database\Seeder;
use App\Tag;

use Faker\Factory as Faker;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $tags = [
        	'Laravel', 
        	'Python', 
        	'PHP', 
        	'Ruby',
        	'Node',
        	'MySQL',
            'Django',
            'Go'
        ];

        foreach($tags as $tag) {
        	Tag::create([
        		'name' => $tag,
        	]);
        }
    }
}
