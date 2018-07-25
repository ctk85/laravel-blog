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
    	// Make sure everyone has the same password
    	$password = Hash::make('king');

    	// Admin user
    	User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => $password,
            'isAdmin' => 1,
            'id' => 1,
            'api_token' => str_random(60),
            'remember_token' => str_random(10)
        ]);

        $faker = Faker::create();
        foreach(range(1,20) as $index) {
        	User::create([
        		'name' => $faker->name,
            	'email' => $faker->unique()->safeEmail,
            	'password' => $password,
                'api_token' => str_random(60),
                'remember_token' => str_random(10)
        	]);
        }
    }
}
