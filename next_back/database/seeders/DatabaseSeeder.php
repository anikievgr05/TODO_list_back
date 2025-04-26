<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => env('NAME_ADMIN'),
            'email' => env('EMAIL_ADMIN'),
            'password' =>  bcrypt(env('PASSWORD_ADMIN')),
            'email_verified_at' => now(),
        ]);
    }
}
