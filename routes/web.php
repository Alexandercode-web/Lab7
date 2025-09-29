<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StudentController;
use App\Models\Student;

// Basic Route
Route::get('/hello', function () {
    return 'Hello, Laravel!';
});

// Route with Parameter
Route::get('/user/{id}', function ($id) {
    return "User ID: $id";
});

// Optional Parameter
Route::get('/greet/{name?}', function ($name = 'Guest') {
    return "Hello, $name";
});

// Named Route
Route::get('/profile', function () {
    return "This is your profile";
})->name('profile');

// Route Group with Prefix 'admin'
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    });
    Route::get('/settings', function () {
        return 'Admin Settings';
    });
});

// Example: Show one student by ID (static demo)
Route::get('/student/{id}', function ($id) {
    $students = [
        1 => ['name' => 'Ana', 'course' => 'IT'],
        2 => ['name' => 'Ben', 'course' => 'CS'],
        3 => ['name' => 'Cara', 'course' => 'IS'],
    ];

    if (!isset($students[$id])) {
        abort(404);
    }

    return view('students.show', ['student' => $students[$id]]);
});

// ✅ Student routes (using controller + named routes)
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::post('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::get('/students/{id}/delete', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
