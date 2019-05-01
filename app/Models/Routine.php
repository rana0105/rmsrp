<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{   

    public function days(){
        return $this->belongsTo('App\Models\WeekDay', 'day_id');
    }

    public function course(){
        return $this->belongsTo('App\Models\Backend\Course', 'course_id');
    }

    public function semesters(){
        return $this->belongsTo('App\Models\Semester', 'semester_id');
    }

    public function timeSlot(){
        return $this->belongsTo('App\Models\TimeSlot', 'time_slots_id');
    }

    public function classRoom(){
        return $this->belongsTo('App\Models\ClassRoom', 'class_room_id');
    }

    public function faculty(){
        return $this->belongsTo('App\User', 'faculty_id');
    }

    

}
