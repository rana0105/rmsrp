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
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $day = Carbon::now()->format( 'l' );
        // $day_of_week = date('N', strtotime($day));
        // $curentDay = $day_of_week + 2;

        $days = WeekDay::pluck('weekday', 'id');
        $course = Course::pluck('title', 'id');
        $semester = Semester::all();
        //dd($semester);
        $faculty = User::pluck('name', 'id');
        $period = TimeSlot::pluck('period', 'time_id');
        $room = ClassRoom::pluck('room_no', 'id'); 

        $routines = Routine::where('faculty_id', Auth::user()->id)
                    ->where('day_id', $day)
                    ->where('semester_id', 1)
                    ->get();   

        return view('home',compact('routines','days', 'course', 'semester', 'room', 'faculty', 'period'));
        return view('home');
    }

    public function searchTeacher(Request $request)
    {
        $day = Carbon::now()->format( 'l' );
        // $day_of_week = date('N', strtotime($day));
        // $curentDay = $day_of_week + 2;

        $days = WeekDay::pluck('weekday', 'id');
        $course = Course::pluck('title', 'id');
        $semester = Semester::all();
        //dd($semester);
        $faculty = User::pluck('name', 'id');
        $period = TimeSlot::pluck('period', 'time_id');
        $room = ClassRoom::pluck('room_no', 'id'); 

        $routines = Routine::where('faculty_id', Auth::user()->id)
                    ->where('day_id', $request->day)
                    ->where('semester_id', $request->semester)
                    ->where('room_type', 1)
                        ->get();          
        return view('searchTeacher',compact('routines','days', 'course', 'semester', 'room', 'faculty', 'period'));
    }
}
