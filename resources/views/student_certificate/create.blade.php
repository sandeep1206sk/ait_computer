    @extends('master.index')
    @section('title', 'Upload Student Certificate')

    @section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">📄 Upload Student Certificate</h3>
                <a href="{{ route('certificates.list.view') }}" class="btn btn-success">📁 View Uploaded Certificates</a>
            </div>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card p-4 shadow-sm">
                <form id="certificateForm" method="POST" action="{{ route('certificates.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="studentSelect" class="form-label">🔍 Search Student by Reg No</label>
                        <select class="form-select" id="studentSelect" name="student_id" required>
                            <option value="" selected disabled>-- Select Reg No --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">
                                    {{ $student->regNo }} — {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="studentDetails" style="display:none;">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">Student Details</div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Name:</strong> <span id="studentName"></span></li>
                                <li class="list-group-item"><strong>Father Name:</strong> <span id="studentFather"></span></li>
                                <li class="list-group-item"><strong>Course:</strong> <span id="studentCourse"></span></li>
                                <li class="list-group-item"><strong>Mobile:</strong> <span id="studentMobile"></span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="certificate" class="form-label">📎 Upload Certificate (PDF/JPG/PNG)</label>
                        <input type="file" class="form-control" id="certificate" name="certificate" accept=".pdf,.jpg,.jpeg,.png" required>
                        @error('certificate')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">📤 Upload Certificate</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Select2 CSS and JS CDN -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#studentSelect').select2({
                placeholder: "-- Select Reg No --",
                width: '100%'
            });
        });

        // Fetch student details on select change
        $('#studentSelect').on('change', function() {
            var studentId = $(this).val();
            if(!studentId) {
                $('#studentDetails').hide();
                return;
            }

            fetch(`/student/${studentId}`)
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    $('#studentDetails').show();
                    $('#studentName').text(data.student.name);
                    $('#studentFather').text(data.student.father_name);
                    $('#studentCourse').text(data.student.course);
                    $('#studentMobile').text(data.student.student_mobile);
                } else {
                    $('#studentDetails').hide();
                    alert('Student not found.');
                }
            })
            .catch(() => {
                $('#studentDetails').hide();
                alert('Error fetching student details.');
            });
        });
    </script>
    @endsection
