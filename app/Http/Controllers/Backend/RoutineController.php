<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\ClassRoom;
use App\Models\Routine;
use App\Models\Semester;
use App\Models\TimeSlot;
use App\Models\WeekDay;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class RoutineController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request  )
    {

        $day = Carbon::now()->format( 'l' );
        $routines = Routine::all();
        $days = WeekDay::pluck('weekday', 'id');
        $course = Course::pluck('title', 'id');
        $semester = Semester::pluck('semester', 'id');
        $faculty = User::pluck('name', 'id');
        $period = TimeSlot::pluck('period', 'time_id');
        $room = ClassRoom::pluck('room_no', 'id');

        return view('backend.routine.index',compact('routines','days', 'course', 'semester', 'room', 'faculty', 'period'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'days' => 'required',
            'faculty' => 'required',
            'course' => 'required',
            'room' => 'required',
            'semester' => 'required',
            'period' => 'required',
            'section' => 'required',
            'room_type' => 'required'
        ]);

        $allCheck = Routine::where('day_id', $request->days)
                        ->where('semester_id', $request->semester)
                        ->where('faculty_id', $request->faculty)
                        ->where('course_id', $request->course)
                        ->where('class_room_id', $request->room)
                        ->where('time_slots_id', $request->period)->first();


        $checkRoomClash = Routine::where('class_room_id', $request->room)
                        ->where('course_id', $request->course)->first();

        $checkTimeClash = Routine::where('time_slots_id', $request->period)
                        ->where('course_id', $request->course)->first();

        $checkFacultyTime = Routine::where('faculty_id', $request->faculty)
                        ->where('time_slots_id', $request->period)->first();

        if (!$allCheck && !$checkRoomClash && !$checkTimeClash && !$checkFacultyTime) {

            $routine = new Routine();
            $routine->day_id = $request->input('days');
            $routine->semester_id = $request->input('semester');             
            $routine->faculty_id = $request->input('faculty');
            $routine->course_id = $request->input('course');        
            $routine->class_room_id = $request->input('room');
            $routine->time_slots_id = $request->input('period');
            $routine->section = $request->input('section');
            $routine->room_type = $request->input('room_type');
            $routine->save();
            
            return redirect()->back()->with('success', 'Routine created successfully');
        }else{

            if ($allCheck) {
                Session::flash('error', "All of not free right now");
                return redirect()->back();
            }elseif ($checkRoomClash) {
                Session::flash('error', "This ClassRoom is not free right now");
                return redirect()->back();
            }elseif ($checkTimeClash) {
                Session::flash('error', "This Time slot is not free right now");
                return redirect()->back();
            }elseif ($checkFacultyTime) {
                Session::flash('error', "This Faculty is not free right now");
                return redirect()->back();
            }else{
                Session::flash('error', "This alldfdfdfdfdfd is not free right now");
                return redirect()->back();
            }
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCourse($id)
    {
        $course = Course::find($id);
        return view('backend.course.editCourse', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',            
            'course_code' => 'required',
        ]);

        $course = Course::find($id);
        $course->update([
            'title' => $request->input('title'),
            'course_code' => $request->input('course_code'),
        ]);
        return redirect()->route('course.index')->with('success', 'Course has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::find($id)->delete();
        return redirect()->route('course.index')->with('success', 'Course has been deleted successfully');
    }
}

