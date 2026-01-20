<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // List students with search
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('division', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(5);

        return view('students.index', compact('students', 'search'));
    }

    // Show create form
    public function create()
    {
        return view('students.create');
    }

    // Store student
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
        ]);

        Student::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'division' => $request->division,
            'district' => $request->district,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    // Edit form
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email,' . $student->id,
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
        ]);

        $student->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'division' => $request->division,
            'district' => $request->district,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    // Delete
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
