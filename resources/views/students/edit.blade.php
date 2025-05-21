@extends('master.index')
@section('title', 'Edit Student')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Student</h4>
                    <a href="{{ route('students.index') }}" class="btn btn-light btn-sm">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $student->name }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Father Name</label>
                                <input type="text" name="father_name" class="form-control" value="{{ $student->father_name }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mother Name</label>
                                <input type="text" name="mother_name" class="form-control" value="{{ $student->mother_name }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Course</label>
                                <input type="text" name="course" class="form-control" value="{{ $student->course }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Student Mobile</label>
                                <input type="text" name="student_mobile" class="form-control" value="{{ $student->student_mobile }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Father Mobile</label>
                                <input type="text" name="parent_mobile" class="form-control" value="{{ $student->parent_mobile }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $student->address }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control" value="{{ $student->category }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="{{ $student->dob }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Photo</label>
                                <input type="file" name="photo" class="form-control">
                                @if($student->photo)
                                    <img src="{{ asset('storage/'.$student->photo) }}" width="100" class="mt-2 rounded shadow-sm">
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Aadhar</label>
                                <input type="file" name="aadhar" class="form-control">
                                @if($student->aadhar)
                                    <img src="{{ asset('storage/'.$student->aadhar) }}" width="100" class="mt-2 rounded shadow-sm">
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Marksheet</label>
                                <input type="file" name="marksheet" class="form-control">
                                @if($student->marksheet)
                                    <img src="{{ asset('storage/'.$student->marksheet) }}" width="100" class="mt-2 rounded shadow-sm">
                                @endif
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success mt-3">Update Student</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div>
    </div>
</div>
@endsection
