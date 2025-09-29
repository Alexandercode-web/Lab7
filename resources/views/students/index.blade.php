<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
</head>
<body>
    <h1>Student List</h1>

    {{-- Success message --}}
    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    {{-- Error messages --}}
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>
        <a href="{{ route('students.create') }}">+ Add New Student</a>
    </p>

    @if ($students->isNotEmpty())
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            @foreach ($students as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->course }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->deleted_at ? 'Deleted' : 'Active' }}</td>
                    <td>
                        @if (!$s->deleted_at)
                            <a href="{{ route('students.edit', $s->id) }}">Edit</a> |
                            <a href="{{ route('students.destroy', $s->id) }}"
                               onclick="return confirm('Soft delete this student?')">Delete</a>
                        @else
                            <a href="{{ route('students.restore', $s->id) }}">Restore</a> |
                            <a href="{{ url('/students/force-delete/' . $s->id) }}"
                               onclick="return confirm('Permanently delete this student?')">Force Delete</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No students yet.</p>
    @endif
</body>
</html>
