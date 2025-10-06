<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class AcademicYear extends Pivot
{
    protected $table = 'academic_years';
    protected $fillable = [
        'name', 
    ];
}
