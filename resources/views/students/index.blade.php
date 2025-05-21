@extends('master.index')
@section('title', 'Student List')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="mb-3">Registered Students</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-white">#</th>
                    <th class="text-white">Photo</th>
                    <th class="text-white">Reg. No</th>
                    <th class="text-white">Name</th>
                    <th class="text-white">Course</th>
                    <th class="text-white">Father Name</th>
                    <th class="text-white">Mobile</th>
                    <th class="text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $key => $student)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                            @else
                                <span class="text-muted">No Photo</span>
                            @endif
                        </td>
                        <td>{{ $student->regNo }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->student_mobile }}</td>
                        <td>
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure to delete this record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
