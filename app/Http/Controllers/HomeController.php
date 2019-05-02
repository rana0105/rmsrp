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
        $time_slots = TimeSlot::all();

        $routines = Routine::where('faculty_id', Auth::user()->id)->get();   

        return view('home',compact('routines', 'time_slots'));
        
    }

    public function searchTeacher(Request $request)
    {
        $time_slots = TimeSlot::all();

        if($request->course_code){
            $course_id = Course::where('course_code', $request->course_code)->first()->id;
            $routines = Routine::where('faculty_id', $request->faculty)
                    ->where('course_id', $course_id)
                        ->get(); 
        }else{
            $routines = Routine::where('faculty_id', $request->faculty)
                        ->get(); 
        }
          
        
        return view('searchTeacher',compact('routines','time_slots'));
    }
}
