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
    	/** Password for all users **/
    	$password = Hash::make('test_password');

    	/** Admin user **/
    	User::create([
            'name' => 'Christopher Keller',
            'email' => 'ckeller@live.com.au',
            'password' => $password,
            'isAdmin' => 1,
            'id' => 1,
            'status' => 1,
            'api_token' => str_random(60)
        ]);

        /** Fake users **/
        $faker = Faker::create();
        foreach(range(2,30) as $index => $value) {
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
