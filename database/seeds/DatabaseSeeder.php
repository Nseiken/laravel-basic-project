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
        // $this->call(UsersTableSeeder::class);
        App\User::create([
            'name' => 'Cristian Garcia',
            'email' => 'cjg@email.com',
            'password' => bcrypt('1qa2ws3ed')
        ]);

        factory(App\Post::class, 30)->create();
    }
}
