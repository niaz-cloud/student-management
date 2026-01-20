<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * GET /api/students
     * Optional query params:
     * ?search=
     * ?division=
     * ?district=
     * ?per_page=
     */
    public function index(Request $request)
    {
        $search   = $request->query('search');
        $division = $request->query('division');
        $district = $request->query('district');
        $perPage  = (int) $request->query('per_page', 10);

        $students = Student::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('division', 'like', "%{$search}%")
                      ->orWhere('district', 'like', "%{$search}%");
                });
            })
            ->when($division, fn ($q) => $q->where('division', $division))
            ->when($district, fn ($q) => $q->where('district', $district))
            ->orderByDesc('id')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Student list',
            'data' => $students,
        ]);
    }

    /**
     * GET /api/students/{student}
     */
    public function show(Student $student)
    {
        return response()->json([
            'success' => true,
            'message' => 'Student details',
            'data' => $student,
        ]);
    }

    /**
     * POST /api/students
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
        ]);

        $student = Student::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully',
            'data' => $student,
        ], 201);
    }

    /**
     * PUT /api/students/{student}
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email,' . $student->id,
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
        ]);

        $student->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully',
            'data' => $student,
        ]);
    }

    /**
     * DELETE /api/students/{student}
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully',
        ]);
    }
}
