<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Country;
use App\Models\Course;
use App\Models\EducationLevel;
use App\Models\EducationSystem;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubCategory;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeders = [];

        if (!Country::query()->where('code', '+20')->exists()) {
            $seeders[] = CountryTableSeeder::class;
        }

        if (!EducationSystem::query()->where('name', 'Egyptian National Education System')->exists()) {
            $seeders[] = EducationSystemTableSeeder::class;
        }

        if (!EducationLevel::query()->where('education_system_id', 1)->where('name', 'Kindergarten')->exists()) {
            $seeders[] = EducationSystemLevelsTableSeeder::class;
        }

        if (!Subject::query()->where('education_level_id', 1)->where('name', 'Arabic')->exists()) {
            $seeders[] = SubjectTableSeeder::class;
        }

        if (!Teacher::query()->where('email', 'taest@gmail.com')->exists()) {
            $seeders[] = TeachersTableSeeder::class;
        }

        if (!Category::query()->where('name', 'Web Development')->exists()) {
            $seeders[] = CategoriesTableSeeder::class;
        }

        if (!SubCategory::query()->where('name', 'Frontend Development')->where('category_id', 1)->exists()) {
            $seeders[] = SubCategoriesTableSeeder::class;
        }

        if (!Course::query()->where('title', 'Frontend Development')->where('teacher_id', 1)->exists()) {
            $seeders[] = CoursesTableSeeder::class;
        }

        if (!Lesson::query()->where('title', 'Frontend Development')->where('teacher_id', 1)->exists()) {
            $seeders[] = LessonsTableSeeder::class;
        }

        if (!User::query()->where('email', 'admin@elmullim.com')->exists()) {
            $seeders[] = UsersTableSeeder::class;
        }

        if (
            !Student::query()->where('email', 'student@elmullim.test')->exists()
            || !\App\Models\Family::query()->where('email', 'parent@elmullim.test')->exists()
            || !Teacher::query()->where('email', 'teacher@elmullim.test')->exists()
        ) {
            $seeders[] = TestAccountsSeeder::class;
        }

        if ($seeders !== []) {
            $this->call($seeders);
        }
    }
}
