@if(!empty($filterTitle))
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <span>{{ $filterTitle }}</span>
        <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-dark">Clear</a>
    </div>
@endif


<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<div class="mb-4 text-center">
    <div class="d-inline-flex flex-wrap gap-2 justify-content-center">
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Dhaka') }}">Dhaka</a>
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Chattogram') }}">Chattogram</a>
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Khulna') }}">Khulna</a>
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Rajshahi') }}">Rajshahi</a>
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Barishal') }}">Barishal</a>
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Sylhet') }}">Sylhet</a>
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Rangpur') }}">Rangpur</a>
        <a class="btn btn-outline-primary btn-sm" href="{{ url('/students/division/Mymensingh') }}">Mymensingh</a>
    </div>
</div>


<body>
<div class="container mt-4">
    <h2>Student List</h2>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search -->
    <form method="GET" action="{{ route('students.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search by name or email">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">Add Student</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No students found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $students->withQueryString()->links() }}
</div>
</body>
</html>
