<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\studentCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentCertificateController extends Controller
{

    public function index()
{
    $certificates = studentCertificate::with('student')->latest()->get();
    return view('certificates.index', compact('certificates'));
}

    public function getStudent($id)
{
    $student = Student::find($id);

    if (!$student) {
        return response()->json(['success' => false, 'message' => 'Student not found.'], 404);
    }

    return response()->json([
        'success' => true,
        'student' => [
            'name' => $student->name,
            'father_name' => $student->father_name,
            'course' => $student->course,
            'student_mobile' => $student->student_mobile,
        ]
    ]);
}

    public function create()
    {
        $students = Student::select('id', 'regNo','name')->get();
        return view('student_certificate.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
    
        $file = $request->file('certificate');
        $path = $file->store('studentCertificate', 'public'); // Store in public disk
    
        studentCertificate::create([
            'student_id' => $request->student_id,
            'certificate_path' => $path,
        ]);
    
        return redirect()->back()->with('success', 'Certificate uploaded successfully!');
    }
    

    public function showCertificates(Request $request)
    {
        $student = Student::with('certificates')->where('id', $request->student_id)->first();
        if(!$student) {
            return response()->json(['error' => 'Student not found']);
        }

        return response()->json([
            'certificates' => $student->certificates
        ]);
    }


    public function destroy($id)
{
    $certificate = studentCertificate::findOrFail($id);

    // Delete the file from storage
    if (Storage::disk('public')->exists($certificate->certificate_path)) {
        Storage::disk('public')->delete($certificate->certificate_path);
    }

    // Delete the database record
    $certificate->delete();

    return redirect()->back()->with('success', 'Certificate deleted successfully.');
}


public function search()
{ 
    // return $request->all();
    // $regNo = $request->input('regNo');

    // $student = Student::where('regNo', $regNo)->first();

    // if (!$student) {
    //     return back()->with('error', 'Student with this Reg No not found.');
    // }

    // $certificates = $student->certificates; // assuming relation 'certificates' exists

    return view('certificates.search_result');
}



public function searchCertificate(Request $request)
{ 
    // return $request->all();
    $regNo = $request->input('regNo');

    $student = Student::where('regNo', $regNo)->first();

    if (!$student) {
        return back()->with('error', 'Student with this Reg No not found.');
    }

    $certificates = $student->certificates; // assuming relation 'certificates' exists

    return view('certificates.search_result',compact('regNo','student','certificates'));
}


}
