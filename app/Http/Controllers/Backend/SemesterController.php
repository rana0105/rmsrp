<?php

namespace App\Http\Controllers\Backend;

<<<<<<< 729483b758363c10a664029ff636645e10caf7d5
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
=======
use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
>>>>>>> semester done

class SemesterController extends Controller
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

    public function index(Request $request)
    {
<<<<<<< 729483b758363c10a664029ff636645e10caf7d5
        $timeslots = TimeSlot::all();
        return view('backend.timeslot.index', compact('timeslots'))
=======
        $semesters = Semester::all();
        return view('backend.semester.index', compact('semesters'))
>>>>>>> semester done
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
<<<<<<< 729483b758363c10a664029ff636645e10caf7d5
            'start_time' => 'required',
            'end_time' => 'required',
            'time_id' => 'required'
            //'slot_status' => 'required'
        ]);

        TimeSlot::create($request->all());
        return redirect()->route('timeslot.index')->with('success', 'Time slot has been save successfully save');
=======
            'semester' => 'required'
        ]);

        Semester::create($request->all());
        return redirect()->route('semester.index')->with('success', 'Semester has been save successfully save');
>>>>>>> semester done
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
    public function edit($id)
    {
        //
    }

<<<<<<< 729483b758363c10a664029ff636645e10caf7d5
    public function editTimeSlot($id)
    {
        $timeslot = TimeSlot::find($id);
        return view('backend.timeslot.editTimeSlot', compact('timeslot'));
=======
    public function editSemester($id)
    {
        $semester = Semester::find($id);
        return view('backend.semester.editSemester', compact('semester'));
>>>>>>> semester done
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
<<<<<<< 729483b758363c10a664029ff636645e10caf7d5
            'start_time' => 'required',
            'end_time' => 'required',
            'time_id' => 'required'
            //'slot_status' => 'required'
        ]);

        $timeslot = TimeSlot::find($id);
        $timeslot->update($request->all());
        return redirect()->route('timeslot.index')->with('success', 'Time slot has been updated successfully');
=======
            'semester' => 'required'
        ]);

        $semester = Semester::find($id);
        $semester->update($request->all());
        return redirect()->route('semester.index')->with('success', 'Semester has been updated successfully');
>>>>>>> semester done
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< 729483b758363c10a664029ff636645e10caf7d5
        TimeSlot::find($id)->delete();
        return redirect()->route('timeslot.index')->with('success', 'Time slot has been deleted successfully');
=======
        Semester::find($id)->delete();
        return redirect()->route('semester.index')->with('success', 'Semester has been deleted successfully');
>>>>>>> semester done
    }
}
