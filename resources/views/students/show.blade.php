@extends('master.index')
@section('title', 'View Student')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl py-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center rounded-top-4">
                <h4 class="mb-0 text-white" >👨‍🎓 Student Profile</h4>
                <a href="{{ route('students.index') }}" class="btn btn-outline-light btn-sm">← Back to List</a>
            </div>

            <div class="card-body px-5 mt-3 ">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        @if($student->photo)
                            <img src="{{ asset('storage/' . $student->photo) }}" class="img-thumbnail rounded-circle shadow" width="150">
                        @else
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:150px; height:150px;">
                                No Photo
                            </div>
                        @endif
                        <h5 class="mt-3">{{ $student->name }}</h5>
                        <span class="badge bg-primary">{{ $student->course }}</span>
                    </div>

                    <div class="col-md-9">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Father's Name</label>
                                <div class="form-control bg-light">{{ $student->father_name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Mother's Name</label>
                                <div class="form-control bg-light">{{ $student->mother_name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Mobile No.</label>
                                <div class="form-control bg-light">{{ $student->student_mobile }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Father's Mobile</label>
                                <div class="form-control bg-light">{{ $student->parent_mobile }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Category</label>
                                <div class="form-control bg-light">{{ $student->category }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Gender</label>
                                <div class="form-control bg-light">{{ $student->gender }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <div class="form-control bg-light">{{ $student->dob }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Reg. No</label>
                                <div class="form-control bg-light">{{ $student->regNo }}</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Address</label>
                                <div class="form-control bg-light">{{ $student->address }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row text-center">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Aadhar</label><br>
                        @if($student->aadhar)
                            <img src="{{ asset('storage/' . $student->aadhar) }}" class="img-fluid border rounded shadow-sm" width="200">
                        @else
                            <p class="text-muted">Not uploaded</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Marksheet</label><br>
                        @if($student->marksheet)
                            <img src="{{ asset('storage/' . $student->marksheet) }}" class="img-fluid border rounded shadow-sm" width="200">
                        @else
                            <p class="text-muted">Not uploaded</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Photo</label><br>
                        @if($student->photo)
                            <img src="{{ asset('storage/' . $student->photo) }}" class="img-fluid border rounded shadow-sm" width="200">
                        @else
                            <p class="text-muted">Not uploaded</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label {
        color: #333;
        font-size: 14px;
    }
    .form-control {
        font-size: 14px;
    }
</style>
@endsection
