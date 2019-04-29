<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WeekDay;
use Illuminate\Http\Request;

class WeekDayController extends Controller
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
        $weekdays = WeekDay::all();
        return view('backend.weekday.index', compact('weekdays'))
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
            'weekday' => 'required'
        ]);

        WeekDay::create($request->all());
        return redirect()->route('weekday.index')->with('success', 'WeekDay has been save successfully save');
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

    public function editWeekDay($id)
    {
        $weekday = WeekDay::find($id);
        return view('backend.weekday.editWeekDay', compact('weekday'));
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
            'weekday' => 'required'
        ]);

        $weekday = WeekDay::find($id);
        $weekday->update($request->all());
        return redirect()->route('weekday.index')->with('success', 'WeekDay has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WeekDay::find($id)->delete();
        return redirect()->route('weekday.index')->with('success', 'WeekDay has been deleted successfully');
    }
}
