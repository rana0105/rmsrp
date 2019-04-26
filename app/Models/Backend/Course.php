<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'course_code',
    ];
}
