<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
{
    $students = Student::latest()->get();
    return view('students.index', compact('students'));
}
    public function create(){
        return view('student.stuRegistration');
    }

    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'course' => 'nullable|string',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'category' => 'nullable|string',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string',
            'parent_mobile' => 'nullable|string',
            'student_mobile' => 'nullable|string',
            'email' => 'nullable|email',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'aadhar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'marksheet' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'admission_date' => 'nullable|date',
            'place' => 'nullable|string',
        ]);
    
        $student = new Student();
        $student->name = $request->name;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->course = $request->course;
        $student->dob = $request->dob;
        $student->gender = $request->gender;
        $student->category = $request->category;
        $student->address = $request->address;
        $student->pincode = $request->pincode;
        $student->parent_mobile = $request->parent_mobile;
        $student->student_mobile = $request->student_mobile;
        $student->email = $request->email;
        $student->admission_date = $request->admission_date;
        $student->place = $request->place;
    
        // Upload files
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('student', 'public');
            $student->photo = $photoPath;
        }
    
        if ($request->hasFile('aadhar')) {
            $aadharPath = $request->file('aadhar')->store('student', 'public');
            $student->aadhar = $aadharPath;
        }
    
        if ($request->hasFile('marksheet')) {
            $marksheetPath = $request->file('marksheet')->store('student', 'public');
            $student->marksheet = $marksheetPath;
        }
    
        $student->save();
    
        // Generate unique regNo
        // $year = Carbon::now()->year;
        $base = 4500;
        $regNo = ($base + $student->id);
        $student->regNo = $regNo;
        $student->save();
    
        return redirect()->back()->with('success', 'Student registered successfully with RegNo: ' . $regNo);
    }



    public function show($id)
{
    $student = Student::findOrFail($id);
    return view('students.show', compact('student'));
}

public function edit($id)
{
    $student = Student::findOrFail($id);
    return view('students.edit', compact('student'));
}


public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        
    ]);

    $student->name = $request->name;
    $student->father_name = $request->father_name;
    $student->mother_name = $request->mother_name;
    $student->course = $request->course;
    $student->parent_mobile = $request->parent_mobile;
    $student->student_mobile = $request->student_mobile;
    $student->category = $request->category;
    $student->address = $request->address;
    $student->pincode = $request->pincode;
    $student->dob = $request->dob;
    $student->gender = $request->gender;

    if ($request->hasFile('photo')) {
        if ($student->photo && Storage::exists('public/' . $student->photo)) {
            Storage::delete('public/' . $student->photo);
        }
        $student->photo = $request->file('photo')->store('uploads/photo', 'public');
    }

    // Handle new aadhar upload and delete old one
    if ($request->hasFile('aadhar')) {
        if ($student->aadhar && Storage::exists('public/' . $student->aadhar)) {
            Storage::delete('public/' . $student->aadhar);
        }
        $student->aadhar = $request->file('aadhar')->store('uploads/aadhar', 'public');
    }

    // Handle new marksheet upload and delete old one
    if ($request->hasFile('marksheet')) {
        if ($student->marksheet && Storage::exists('public/' . $student->marksheet)) {
            Storage::delete('public/' . $student->marksheet);
        }
        $student->marksheet = $request->file('marksheet')->store('uploads/marksheet', 'public');
    }

    $student->save();

    return redirect()->route('students.index')->with('success', 'Student updated successfully.');
}


public function destroy($id)
{
    $student = Student::findOrFail($id);
    
    // Delete files if needed
    if ($student->photo && file_exists(public_path('student/'.$student->photo))) {
        unlink(public_path('student/'.$student->photo));
    }

    $student->delete();
    return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
}

public function showStudentForm()
    {
        $students = Student::select('id', 'regNo')->get();
        return view('student.details', compact('students'));
    }

    public function fetchStudentDetails(Request $request)
    {
        $student = Student::where('regNo', $request->regNo)->first();
        if ($student) {
            return response()->json([
                'success' => true,
                'student' => $student
            ]);
        }
        return response()->json(['success' => false]);
    }

    public function uploadDocuments(Request $request, Student $student)
    {
        $request->validate([
            'marksheet' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'certificate' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('marksheet')) {
            $marksheetPath = $request->file('marksheet')->store('documents/marksheets');
            $student->marksheet = $marksheetPath;
        }

        if ($request->hasFile('certificate')) {
            $certificatePath = $request->file('certificate')->store('documents/certificates');
            $student->certificate = $certificatePath;
        }

        $student->save();

        return redirect()->back()->with('success', 'Documents uploaded successfully!');
    }

    public function viewDocument($filename)
    {
        $path = storage_path('app/documents/' . $filename);
        if (!file_exists($path)) abort(404);
        $mime = mime_content_type($path);
        return response()->file($path, ['Content-Type' => $mime]);
    }

    public function downloadDocument($filename)
    {
        $path = storage_path('app/documents/' . $filename);
        if (!file_exists($path)) abort(404);
        return response()->download($path);
    }

}
