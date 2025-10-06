<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class classes extends Pivot
{
    use HasFactory;

    protected $table = 'classes'; 
    protected $fillable = [
        'name'
    ];
}


