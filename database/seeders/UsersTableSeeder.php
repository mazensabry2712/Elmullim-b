<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@elmullim.com'],
            [
                'name' => 'Admin User',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );
    }
}
