@extends('master.index')
@section('title', 'AIT Computer Registration Form')
@section('content')

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
  }

  .form-container {
    background-color: #fff;
    padding: 40px;
    width: 95%;
    max-width: 1200px;
    margin: 40px auto;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
    border-radius: 12px;
    overflow-x: hidden;
  }

  h1, h2 {
    text-align: center;
    margin-bottom: 5px;
  }

  .institute-info {
    text-align: center;
    font-size: 15px;
    margin-bottom: 25px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
  }

  label {
    font-weight: 600;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="email"],
  input[type="date"],
  input[type="number"],
  input[type="file"],
  select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    width: 100%;
  }

  .form-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
  }

  .form-row .form-group {
    flex: 1 1 30%;
  }

  .declaration {
    margin-top: 30px;
    padding: 15px;
    border: 2px dashed #888;
    background-color: #fdfdfd;
    font-size: 14px;
  }

  .signature {
    margin-top: 30px;
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
  }

  .signature .form-group {
    flex: 1;
  }

  button {
    display: block;
    width: 100%;
    padding: 14px;
    margin-top: 30px;
    background-color: #0066cc;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
  }

  button:hover {
    background-color: #004c99;
  }

  @media (max-width: 768px) {
    .form-row {
      flex-direction: column;
    }
  }
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="form-container">
  <h1>AIT COMPUTER</h1>
  <h2>ARADHYA INSTITUTE OF TECHNOLOGY</h2>
  <div class="institute-info">
    Ganeshpuri Road, Chhoti Gate, Susuwahi, Varanasi<br>
    <strong>Mob. No.:</strong> 9451118782, 9555610401
  </div>

  <form action="{{route('storeStudent')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="course">Course Applied For</label>
      <input type="text" id="course" name="course">
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="first-name">Full Name</label>
        <input type="text" id="first-name" name="name">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="father-name">Father's/Guardian's Name</label>
        <input type="text" id="father-name" name="father_name">
      </div>
      <div class="form-group">
        <label for="mother-name">Mother's Name</label>
        <input type="text" id="mother-name" name="mother_name">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob">
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <input type="text" id="category" name="category">
      </div>
    </div>

    <div class="form-group">
      <label for="residence-address">Full Address</label>
      <input type="text" id="residence-address" name="address">
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="pincode">Pin Code</label>
        <input type="number" id="pincode" name="pincode">
      </div>
      <div class="form-group">
        <label for="parent-mobile">Mobile (Parent)</label>
        <input type="text" id="parent-mobile" name="parent_mobile">
      </div>
      <div class="form-group">
        <label for="student-mobile">Mobile (Student)</label>
        <input type="text" id="student-mobile" name="student_mobile">
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email-ID</label>
      <input type="email" id="email" name="email">
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="photo">Upload Passport Size Photo</label>
        <input type="file" id="photo" name="photo" accept="image/*">
      </div>
      <div class="form-group">
        <label for="aadhar">Upload Aadhar Card Photo</label>
        <input type="file" id="aadhar" name="aadhar" accept="image/*,application/pdf">
      </div>
      <div class="form-group">
        <label for="marksheet">Upload Marksheet Photo</label>
        <input type="file" id="marksheet" name="marksheet" accept="image/*,application/pdf">
      </div>
    </div>

    <div class="declaration">
      <strong>DECLARATION:</strong><br>
      I hereby declare that all the particulars given in this application are true to the best of my knowledge and belief.
    </div>

    <div class="signature">
      <div class="form-group">
        <label for="admission-date">Admission Date</label>
        <input type="date" id="admission-date" name="admission_date">
      </div>
      <div class="form-group">
        <label for="place">Place</label>
        <input type="text" id="place" name="place">
      </div>
    </div>

    <button type="submit">Submit Form</button>
  </form>
</div>
@endsection
