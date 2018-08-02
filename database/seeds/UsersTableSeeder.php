<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Create password to be used for all entries
    	$password = Hash::make('supernova');

    	// Admin user
    	User::create([
            'name' => 'Chris Keller',
            'email' => 'ctk8501@gmail.com',
            'password' => $password,
            'isAdmin' => 1,
            'id' => 1,
            'status' => 1,
            'api_token' => str_random(60)
        ]);

        $faker = Faker::create();
        foreach(range(2,20) as $index => $value) {
        	User::create([
        		'name' => $faker->name,
            	'email' => $faker->unique()->safeEmail,
            	'password' => $password,
                'id' => $value,
                'api_token' => str_random(60)
        	]);
        } 
    }
}
