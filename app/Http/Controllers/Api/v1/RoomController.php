<?php

//namespace App\Http\Controllers;

// For versioning modified namespace        - Always add it to new controller
namespace App\Http\Controllers\Api\v1;

// For versioning controller        - Always add it to new controller
use App\Http\Controllers\Controller;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only active data
        // return Room::where('active_status', 'Active')->get();

        // All data
        return Room::all();
        // Return with relationships
        //return Room::with('user', 'created_by_user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'room_number' => 'required',
            'building' => 'required',
            'floor' => 'required'
        ]);

        return Room::create($request->all());
        
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
        return Room::find($id);

        //return Room::with('user', 'created_by_user')->find($id);
    }

    public function edit($id)
    {
        // Default
        // return Room::find($id);

        return Room::with('user', 'created_by_user')->find($id);
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
        //
        $room = Room::find($id);
        $room->update($request->all());

        return $room;
    }
    
    public function restore(Room $room, $id)
    {
        //
        $room = Room::onlyTrashed()->where('id', $id)->restore();
        return Room::find($id);
    }

    public function destroy(Room $room, $id)
    {
        //if the model soft deleted
        $room = Room::find($id);

        $room->delete();
        return $room;
    }

    public function show_soft_deleted($all)
    {
        $room = Room::onlyTrashed()->get();

        return $room;
    }

    public function search($title)
    {

        return Room::where('email', 'like', '%'.$title.'%')->get();
    }
    //
}
