@extends('master.index')
@section('title', 'Certificate List')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary">📁 Uploaded Certificates</h3>
            <a href="{{ route('certificates.create') }}" class="btn btn-success btn-lg">
                <i class="bi bi-upload me-2"></i> Upload New Certificate
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary text-uppercase text-secondary">
                        <tr>
                            <th>Reg No</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Mobile</th>
                            <th>Certificate</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($certificates as $certificate)
                        <tr class="align-middle">
                            <td class="fw-semibold">{{ $certificate->student->regNo }}</td>
                            <td>{{ $certificate->student->name }}</td>
                            <td><span class="badge bg-info text-dark">{{ $certificate->student->course }}</span></td>
                            <td><a href="tel:{{ $certificate->student->student_mobile }}" class="text-decoration-none">{{ $certificate->student->student_mobile }}</a></td>
                            <td>
                                @php
                                    $ext = strtolower(pathinfo($certificate->certificate_path, PATHINFO_EXTENSION));
                                @endphp

                                @if($ext === 'pdf')
                                    <a href="{{ asset('storage/' . $certificate->certificate_path) }}" target="_blank" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View PDF Certificate">
                                        <i class="bi bi-file-earmark-pdf"></i> View PDF
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $certificate->certificate_path) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="View Image Certificate">
                                        <img src="{{ asset('storage/' . $certificate->certificate_path) }}" alt="Certificate Image" class="img-thumbnail" style="max-width: 120px; max-height: 80px;">
                                    </a>
                                @endif
                                <br>
                                <a href="{{ asset('storage/' . $certificate->certificate_path) }}" download class="btn btn-outline-primary btn-sm mt-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Certificate">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this certificate?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Certificate">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4 fs-5">
                                <i class="bi bi-folder-x fs-3 mb-2"></i><br>
                                No certificates uploaded yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons CDN for icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Enable Bootstrap 5 tooltips -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
