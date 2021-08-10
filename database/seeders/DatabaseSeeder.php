<?php

namespace Database\Seeders;

use Hash;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name'              => 'user1',
            'email'             => 'user1@gmail.com',
            'username'          => 'user1234',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),

        ]);
        \App\Models\User::create([
            'name'              => 'user2',
            'email'             => 'user2@gmail.com',
            'username'          => 'user2234',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),

        ]);
    }
}
