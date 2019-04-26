<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $timeslots = TimeSlot::all();
        return view('backend.timeslot.index', compact('timeslots'))
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
            'start_time' => 'required',
            'end_time' => 'required',
            'time_id' => 'required'
            //'slot_status' => 'required'
        ]);

        TimeSlot::create($request->all());
        return redirect()->route('timeslot.index')->with('success', 'Time slot has been save successfully save');
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

    public function editTimeSlot($id)
    {
        $timeslot = TimeSlot::find($id);
        return view('backend.timeslot.editTimeSlot', compact('timeslot'));
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
            'start_time' => 'required',
            'end_time' => 'required',
            'time_id' => 'required'
            //'slot_status' => 'required'
        ]);

        $timeslot = TimeSlot::find($id);
        $timeslot->update($request->all());
        return redirect()->route('timeslot.index')->with('success', 'Time slot has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TimeSlot::find($id)->delete();
        return redirect()->route('timeslot.index')->with('success', 'Time slot has been deleted successfully');
    }
}
