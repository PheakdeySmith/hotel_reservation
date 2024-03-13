<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class RoomController extends Controller
{
    public function index(){
        $data['rooms'] = Room::all();
        $data['room_types'] = RoomType::all();
        return view('admin.rooms.room.index', $data);
    }

    public function create(){
        $data['room_types'] = RoomType::all();
        return view('admin.rooms.room.create', $data);
    }

    public function store(Request $request){
        $request->validate([
            'room_number' => 'required',
            'roomtype_id' => 'required',
            'room_name' => 'required',
        ]);

        $room = new Room();
        $room->room_number = $request->input('room_number');
        $room->roomtype_id = $request->input('roomtype_id');
        $room->room_name = $request->input('room_name');

        $room->save();

        return Redirect::route('admin.room.index')->with('success', 'Room created successfully');
    }


}
