<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\studentCertificate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
   {
      $student=Student::count();
      $certificate=studentCertificate::count();
    return view('home',compact('student','certificate'));
   }
}
