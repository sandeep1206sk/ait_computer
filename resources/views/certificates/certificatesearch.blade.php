@extends('master.index')
@section('title', 'Search Certificates')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="mb-4">🔎 Search Certificates by Reg No</h3>

        <form action="{{ route('certificates.search') }}" method="GET" class="mb-4">
            <div class="input-group" style="max-width: 400px;">
                <input type="text" name="regNo" class="form-control" placeholder="Enter Reg No" value="{{ old('regNo', $regNo ?? '') }}" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(isset($student))
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    Student: {{ $student->name }} (Reg No: {{ $student->regNo }})
                </div>
                <div class="card-body">
                    @if($certificates->count() > 0)
                        <div class="row g-3">
                            @foreach($certificates as $certificate)
                                <div class="col-md-4">
                                    <div class="card shadow-sm">
                                        <div class="card-body text-center">
                                            @php
                                                $ext = pathinfo($certificate->certificate_path, PATHINFO_EXTENSION);
                                            @endphp

                                            @if(strtolower($ext) === 'pdf')
                                                <a href="{{ asset('storage/' . $certificate->certificate_path) }}" target="_blank" class="btn btn-outline-info w-100 mb-2">📄 View PDF</a>
                                            @else
                                                <a href="{{ asset('storage/' . $certificate->certificate_path) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $certificate->certificate_path) }}" alt="Certificate" class="img-fluid rounded" style="max-height: 150px;">
                                                </a>
                                            @endif

                                            <a href="{{ asset('storage/' . $certificate->certificate_path) }}" download class="btn btn-outline-primary w-100 mt-2">⬇️ Download</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">No certificate uploaded or found for this student.</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
