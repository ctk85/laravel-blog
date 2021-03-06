<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PostTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(LikePostTableSeeder::class);
    }
}
