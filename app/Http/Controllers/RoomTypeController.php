<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoomTypeController extends Controller
{
    public function index(){
        $data['room_types'] = RoomType::all();
        return view('admin.rooms.room_types.index', $data);
    }

    public function create(){
        return view('admin.rooms.room_types.create');
    }

    public function store(Request $request){
        $request->validate([
            'roomtype_name' => 'required',
        ]);

        try{
            $roomType = new RoomType();
            $roomType->roomtype_name = $request->input('roomtype_name');
            $roomType->save();

            return Redirect::route('admin.roomtype.index')->with('success', 'Room Type created successfully');
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Error creating room type: ' . $e->getMessage());
        }
    }

    public function edit($id){
        try{

            $data['room_types'] = RoomType::findOrFail($id);
            return view('admin.rooms.room_types.edit', $data);

        } catch (\Exception $e) {
            return Redirect::route('admin.roomtype.index')->with('error', 'Room Type not found');
        }
    }

    public function update(Request $request, $id){
        try{
            $roomType = RoomType::findOrFail($id);
            $roomType->update($request->all());

            return Redirect::route('admin.roomtype.index')->with('success', 'Room Type updated successfully');
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Error updating room type: ' . $e->getMessage());
        }
    }

    public function destroy($id){
        try{
            $roomType = RoomType::findOrFail($id);
            $roomType->delete();

            return Redirect::route('admin.roomtype.index')->with('success', 'Customer Type deleted successfully');
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Error deleting room type: ' . $e->getMessage());
        }
    }
}
