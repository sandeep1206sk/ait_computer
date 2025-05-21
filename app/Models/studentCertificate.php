<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentCertificate extends Model
{
    use HasFactory;
    
    protected $fillable = ['student_id', 'certificate_path'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
