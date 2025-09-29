<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // Display all students (with trashed)
    public function index() {
        $students = Student::withTrashed()->latest()->get();
        return view('students.index', compact('students'));
    }

    // Show the create student form
    public function create() {
        return view('students.create');
    }

    // Handle form submission
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:3',
            'course' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('students', 'email')->whereNull('deleted_at'),
            ],
        ]);

        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    // Show edit form
    public function edit($id) {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

   
    public function update(Request $request, $id) {
        $student = Student::find($id);

        $student->name = $request->input('fullname');
        $student->course = $request->course;
        $student->email = $request->mail;

        $student->savee(); 
        return redirect('/student'); 
    }

    // Soft delete student
    public function destroy($id) {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted (soft delete).');
    }

    // Restore student
    public function restore($id) {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route('students.index')->with('success', 'Student restored successfully!');
    }
}
