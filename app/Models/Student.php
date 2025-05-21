<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'name',
        'father_name',
        'mother_name',
        'dob',
        'gender',
        'category',
        'address',
        'pincode',
        'parent_mobile',
        'student_mobile',
        'email',
        'photo',
        'aadhar',
        'marksheet',
        'admission_date',
        'place',
        'regNo',
    ];

    public function certificates()
{
    return $this->hasMany(StudentCertificate::class);
}
}
