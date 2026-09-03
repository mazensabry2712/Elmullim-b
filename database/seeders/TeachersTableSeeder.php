<?php

namespace Database\Seeders;

use App\Enums\GenderTypesEnums;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::query()->updateOrCreate(
            [
                'email' => 'taest@gmail.com',
            ],
            [
                'name' => 'test',
                'email_verified_at' => now(),
                'phone' => '0123456789',
                'password' => Hash::make('password'),
                'address' => 'test address',
                'description' => 'test description',
                'education_level_id' => 1,
                'gender' => GenderTypesEnums::Male,
            ]
        );
    }
}
