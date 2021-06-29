<?php

namespace Database\Seeders;

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
        // Create dev user.
        User::factory()->create([
            'name' => 'Example User',
            'username' => 'therelExample',
            'email' => 'example@example.com',
            'password' => bcrypt('password'),
        ]);


         \App\Models\User::factory(10)->create();
    }
}
