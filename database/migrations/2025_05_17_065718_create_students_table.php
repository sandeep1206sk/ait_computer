<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('course')->nullable();
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('category')->nullable();
            $table->text('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('parent_mobile')->nullable();
            $table->string('student_mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->string('aadhar')->nullable();
            $table->string('marksheet')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('place')->nullable();
            $table->string('regNo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
