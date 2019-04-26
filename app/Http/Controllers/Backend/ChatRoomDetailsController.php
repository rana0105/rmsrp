<?php

namespace App\Http\Controllers\Backend;

use App\Models\Portal;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\Backend\Chatroom;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Backend\ChatRoomDetails;
use Illuminate\Support\Facades\Storage;

class ChatRoomDetailsController extends Controller
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
         
        $chatrooms = ChatRoomDetails::all();    
        return view('backend.chatroom.index', compact('chatrooms'))
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
            'chatroom_name' => 'required|unique:chat_room_details',
            'portal_id' => 'required',
            // 'membership_id' => 'required',
            'chatroom_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
            ]);
            if($image = $request->file('chatroom_image')){
                $name = uniqid().$image->getClientOriginalName();
                $chatroomImg = $image->move('uploads/chatRoomCoverImages', $name);
            }
        ChatRoomDetails::create($request->except('chatroom_image','membership_id')+['chatroom_image' => $chatroomImg,'membership_id' => 2]);
        
        return redirect()->route('chatroom.index')->with('success', 'Chatroom Information created successfully !');
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

    public function chatroomEdit($id)
    {
        $chatroom = ChatRoomDetails::find($id);
        return view('backend.chatroom.editChatroom', compact('chatroom'));
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
            'chatroom_image' => 'nullable|image|max:2048'
        ]);

        $chatroom = ChatRoomDetails::find($id);

        // for chatroom image update
        $chatroomImg = $chatroom->chatroom_image;
        if($image = $request->file('chatroom_image')){
            $name = uniqid().$image->getClientOriginalName();
            $chatroomImg = $image->move('uploads/chatRoomCoverImages', $name);
            Storage::disk('uploads')->delete($chatroom->chatroom_image);
        }

        // chatroom info update
        $chatroom->update($request->except('chatroom_image')+['chatroom_image' => $chatroomImg,'membership_id' => 2]);

        return redirect()->route('chatroom.index')->with('success', 'Chatroom Information updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ChatRoomDetails::find($id)->delete();
        // return redirect()->back()->with('success', 'Chatroom has been deleted successfully');
        
        $chatroom = ChatRoomDetails::find($id);
        if($chatroom->delete())
           Storage::disk('uploads')->delete($chatroom->chatroom_image);
        return redirect()->back()->with('success', 'Chatroom has been deleted successfully');
    }
}
