<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('user')->insert([
            'name' => 'Fletch',
            'email' => 'fletch@fletchy.net',
            'password' => bcrypt('1'),
        ]);

        DB::table('category')->insert(['name' => 'Funny']);
        DB::table('category')->insert(['name' => 'Animals']);
        DB::table('category')->insert(['name' => 'News']);
        DB::table('category')->insert(['name' => 'Food']);
        DB::table('category')->insert(['name' => 'Creepy']);
        DB::table('category')->insert(['name' => 'Feels']);
        DB::table('category')->insert(['name' => 'Gaming']);
        DB::table('category')->insert(['name' => 'Nostalgia']);
    }
}
