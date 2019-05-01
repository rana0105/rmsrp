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
        $day_of_week = date('N', strtotime($day));
        $curentDay = $day_of_week + 2;

        $days = WeekDay::pluck('weekday', 'id');
        $course = Course::pluck('title', 'id');
        $semester = Semester::all();
        //dd($semester);
        $faculty = User::pluck('name', 'id');
        $period = TimeSlot::pluck('period', 'time_id');
        $room = ClassRoom::pluck('room_no', 'id'); 

        $routines = Routine::where('day_id', $curentDay)
                    ->where('semester_id', 1)
                        ->get();
                        
        return view('pages.theory',compact('routines','days', 'course', 'semester', 'room', 'faculty', 'period'));
    }


    public function searchTheory(Request $request)
    {
        $day = Carbon::now()->format( 'l' );
        $day_of_week = date('N', strtotime($day));
        $curentDay = $day_of_week + 2;

        $days = WeekDay::pluck('weekday', 'id');
        $course = Course::pluck('title', 'id');
        $semester = Semester::all();
        //dd($semester);
        $faculty = User::pluck('name', 'id');
        $period = TimeSlot::pluck('period', 'time_id');
        $room = ClassRoom::pluck('room_no', 'id'); 

        $routines = Routine::where('day_id', $request->day)
                    ->where('semester_id', $request->semester)
                        ->get();          
        return view('pages.searchTheory',compact('routines','days', 'course', 'semester', 'room', 'faculty', 'period'));
    }
    
    public function lab()
    {
        return view('pages.lab');
    }

    
}
