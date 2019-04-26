<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Announcement;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $announcements = Announcement::all();    
            return view('backend.announcement.index', compact('announcements'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function announcementList(){
        $announcements = Announcement::where('portal_id',auth()->user()->portalInfo->portal_id)->get();
        return view('frontEnd.announcements', compact('announcements'));
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
            'detail' => 'required',
            'portal_id' => 'required',
            ]);

        Announcement::create($request->all());
        return redirect()->route('announcement.index')->with('success', 'Announcement created successfully !');
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
        
    }

    public function announcementEdit($id)
    {
        $announcement = Announcement::find($id);
        return view('backend.announcement.editAnnouncement', compact('announcement'));
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
            'detail' => 'required',
            'portal_id' => 'required',
            ]);
        $announcement = Announcement::find($id);
        $announcement->update($request->all());        
        return redirect()->route('announcement.index')->with('success', 'Announcement updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = Announcement::find($id);
        if($announcement->delete())
        return redirect()->back()->with('success', 'Announcement has been deleted successfully');
    }
}
