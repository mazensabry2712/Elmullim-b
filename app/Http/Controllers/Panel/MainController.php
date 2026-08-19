<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use App\Models\Family;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Display the main panel page.
     */
    public function index()
    {
        // $recentStudents = Student::latest()->take(5)->get();
        $todayTransactions = Transaction::whereDate('created_at', today())->latest()->get();
        $todayStudents = Student::whereDate('created_at', today())->latest()->get();
        $todayAdmins = User::whereDate('created_at', today())->latest()->get();
        $todayTeachers = Teacher::whereDate('created_at', today())->latest()->get();
        $todayFamilies = Family::whereDate('created_at', today())->latest()->get();
        $adminsCount = User::count();
        $teachersCount = Teacher::count();
        $studentsCount = Student::count();
        $familiesCount = Family::count();

        return view("panel.panel", compact('todayTransactions', 'todayFamilies', 'todayAdmins', 'todayTeachers', 'adminsCount', 'todayStudents', 'teachersCount', 'studentsCount', 'familiesCount'));
    }

}
