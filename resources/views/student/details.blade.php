@extends('master.index')
@section('title', 'Student Details & Documents')

@section('content')
<div class="content-wrapper">
    <!-- Content -->
  
    <div class="container-xxl flex-grow-1 container-p-y">
    <h3 class="mb-4">Student Details & Document Upload</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <label for="regNoSelect" class="form-label fw-semibold">Select Registration Number</label>
        <select id="regNoSelect" class="form-select">
            <option value="" selected disabled>-- Select Reg No --</option>
            @foreach($students as $student)
                <option value="{{ $student->regNo }}">{{ $student->regNo }}</option>
            @endforeach
        </select>
    </div>

    <div id="studentDetails" style="display:none;">
        <h5>Student Info</h5>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Name:</strong> <span id="studentName"></span></li>
            <li class="list-group-item"><strong>Father Name:</strong> <span id="studentFather"></span></li>
            <li class="list-group-item"><strong>Course:</strong> <span id="studentCourse"></span></li>
            <li class="list-group-item"><strong>Mobile:</strong> <span id="studentMobile"></span></li>
        </ul>

        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="studentId" name="student_id" value="">
            
            <div class="mb-3">
                <label for="marksheet" class="form-label">Upload Marksheet (PDF/Image)</label>
                <input type="file" class="form-control" name="marksheet" id="marksheet" accept=".pdf,.jpg,.jpeg,.png">
            </div>

            <div class="mb-3">
                <label for="certificate" class="form-label">Upload Certificate (PDF/Image)</label>
                <input type="file" class="form-control" name="certificate" id="certificate" accept=".pdf,.jpg,.jpeg,.png">
            </div>

            <button type="submit" class="btn btn-primary">Upload Documents</button>
        </form>

        <hr>

        <h5>Uploaded Documents</h5>
        <div id="uploadedDocs">
            <p>No documents uploaded yet.</p>
        </div>
    </div>
</div>
</div>

<script>
document.getElementById('regNoSelect').addEventListener('change', function() {
    const regNo = this.value;
    if(!regNo) return;

    fetch("{{ route('student.fetch') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({ regNo: regNo })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            const student = data.student;
            document.getElementById('studentDetails').style.display = 'block';
            document.getElementById('studentName').innerText = student.name || '';
            document.getElementById('studentFather').innerText = student.father_name || '';
            document.getElementById('studentCourse').innerText = student.course || '';
            document.getElementById('studentMobile').innerText = student.student_mobile || '';
            document.getElementById('studentId').value = student.id;

            // Show uploaded documents if available
            const docsDiv = document.getElementById('uploadedDocs');
            docsDiv.innerHTML = '';

            if(student.marksheet) {
                docsDiv.innerHTML += `
                <div>
                    <strong>Marksheet: </strong>
                    <a href="{{ url('storage') }}/${student.marksheet}" target="_blank" class="btn btn-sm btn-outline-primary me-2">View</a>
                    <a href="{{ url('storage') }}/${student.marksheet}" download class="btn btn-sm btn-outline-success">Download</a>
                </div>`;
            }

            if(student.certificate) {
                docsDiv.innerHTML += `
                <div class="mt-2">
                    <strong>Certificate: </strong>
                    <a href="{{ url('storage') }}/${student.certificate}" target="_blank" class="btn btn-sm btn-outline-primary me-2">View</a>
                    <a href="{{ url('storage') }}/${student.certificate}" download class="btn btn-sm btn-outline-success">Download</a>
                </div>`;
            }

            if(!student.marksheet && !student.certificate) {
                docsDiv.innerHTML = '<p>No documents uploaded yet.</p>';
            }
        } else {
            alert('Student not found!');
            document.getElementById('studentDetails').style.display = 'none';
        }
    });
});

document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const studentId = formData.get('student_id');

    fetch(`/student/upload-documents/${studentId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => {
        if(response.ok) {
            return response.text();
        } else {
            throw new Error('Upload failed');
        }
    })
    .then(() => {
        alert('Documents uploaded successfully!');
        location.reload(); // Reload page to show updated data
    })
    .catch(err => alert(err.message));
});
</script>
@endsection
