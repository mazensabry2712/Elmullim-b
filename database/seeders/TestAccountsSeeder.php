<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestAccountsSeeder extends Seeder
{
    public function run(): void
    {
        $educationLevelId = \App\Models\EducationLevel::query()->value('id');

        if (!$educationLevelId) {
            throw new \RuntimeException('TestAccountsSeeder requires at least one education level. Run the education level seeder first.');
        }

        Student::query()->updateOrCreate(
            ['email' => 'student@elmullim.test'],
            [
                'name' => 'Test Student',
                'password' => Hash::make('Student@123'),
                'phone' => '01000000001',
                'address' => 'Test Address',
                'email_verified_at' => now(),
                'gender' => 'male',
                'education_level_id' => $educationLevelId,
                'description' => 'Test student account for frontend/API testing.',
            ]
        );

        $family = Family::query()->updateOrCreate(
            ['email' => 'parent@elmullim.test'],
            [
                'name' => 'Test Parent',
                'password' => Hash::make('Parent@123'),
                'phone' => '01000000002',
                'email_verified_at' => now(),
                'gender' => 'male',
                'education_level_id' => $educationLevelId,
                'description' => 'Test parent account for frontend/API testing.',
            ]
        );

        $student = Student::query()->where('email', 'student@elmullim.test')->first();
        $family->students()->syncWithoutDetaching([$student->id]);

        $teacher = Teacher::query()->updateOrCreate(
            ['email' => 'teacher@elmullim.test'],
            [
                'name' => 'Test Teacher',
                'password' => Hash::make('Teacher@123'),
                'phone' => '01000000003',
                'address' => 'Test Address',
                'email_verified_at' => now(),
                'gender' => 'male',
                'education_level_id' => $educationLevelId,
                'description' => 'Test teacher account for frontend/API testing.',
                'qualification' => 'Bachelor Degree',
                'experince' => 5,
            ]
        );

        $subjectId = \App\Models\Subject::query()->value('id');
        if ($subjectId) {
            $teacher->subjects()->syncWithoutDetaching([$subjectId]);
        }
    }
}
