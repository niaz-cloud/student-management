@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Details</h1>
    <a href="{{ route('students.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $student->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $student->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $student->updated_at }}</td>
        </tr>
    </table>
</div>
@endsection
