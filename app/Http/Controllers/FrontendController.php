<?php

namespace App\Http\Controllers;

use App\Models\Backend\Course;
use App\Models\ClassRoom;
use App\Models\Routine;
use App\Models\Semester;
use App\Models\TimeSlot;
use App\Models\WeekDay;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function theory()
    {
        
        $day = Carbon::now()->format( 'l' );
        $routines = Routine::all();
        $days = WeekDay::pluck('weekday', 'id');
        $course = Course::pluck('title', 'id');
        $semester = Semester::pluck('semester', 'id');
        $faculty = User::pluck('name', 'id');
        $period = TimeSlot::pluck('period', 'time_id');
        $room = ClassRoom::pluck('room_no', 'id');

        return view('pages.theory',compact('routines','days', 'course', 'semester', 'room', 'faculty', 'period'));
    }
    
    public function lab()
    {
        return view('pages.lab');
    }

    
}
