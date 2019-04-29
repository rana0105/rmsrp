<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Routine;
use App\Models\WeekDay;
use App\Models\Semester;
use App\Models\ClassRoom;
use App\Models\TimeSlot;
use App\Models\Backend\Course;

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
        $routines = Routine::all();
        $days = WeekDay::pluck('weekday', 'id');
        $course = Course::pluck('title', 'id');
        $semester = Semester::pluck('semester', 'id');
        // $time = TimeSlot::pluck('');
        $room = ClassRoom::pluck('room_no', 'id');

        return view('backend.routine.index',compact('routines','days', 'course', 'semester', 'room'))
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
            'title' => 'required',
            'course_code' => 'required',
            ]);

        $course = new Course();
        $course->title = $request->input('title');
        $course->course_code = $request->input('course_code');
        $course->save();
        
        return redirect()->back()->with('success', 'Course created successfully');
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

