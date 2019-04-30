<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{   

    public function days(){
        return $this->belongsTo('App\Models\WeekDay', 'id');
    }

    public function course(){
        return $this->belongsTo('App\Models\Backend\Course', 'course_id');
    }

    public function semesters(){
        return $this->belongsTo('App\Models\Semester', 'id');
    }

    public function timeSlot(){
        return $this->belongsTo('App\Models\TimeSlot', 'id');
    }

    public function classRoom(){
        return $this->belongsTo('App\Models\ClassRoom', 'id');
    }

    public function faculty(){
        return $this->belongsTo('App\User', 'faculty_id');
    }

    

}
