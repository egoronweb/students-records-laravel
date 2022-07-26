<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'fullname',
        'subject',
        'semester',
        'year',
        'year_level',
        'final_grade',
    ];
}
