<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>

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

    <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}"><br><br>

        <label for="course">Course:</label><br>
        <input type="text" id="course" name="course" value="{{ old('course', $student->course) }}"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}"><br><br>

        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('students.index') }}">Back to list</a></p>
</body>
</html>
