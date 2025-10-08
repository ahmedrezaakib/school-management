<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Period extends Model
{
    protected $fillable = [
        'class_id',
        'subject_id',
        'teacher_id',
        'day_of_week',
        'start_time',
        'end_time',
        'room',
        'academic_year_id'
    ];

    public function class()
    {
        // If your model for classes is named 'Classes', use Classes::class
        return $this->belongsTo(\App\Models\Classes::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(\App\Models\User::class, 'teacher_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(\App\Models\AcademicYear::class, 'academic_year_id');
    }
}
