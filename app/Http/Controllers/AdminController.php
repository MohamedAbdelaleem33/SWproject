<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Branch;


class AdminController extends Controller
{
    //
    public function viewDashboard(){
        
        $no_customers = Customer::count();
        $no_rooms = Room::count();
        $no_reservations = Reservation::count();
        $rooms = Room::get();
        $reservations = Reservation::get();

        $sumOfProfit = Room::join('reservations','reservations.room_id','=','rooms.room_id')->sum('reservations.total_amount');
        
        return view('admin.layouts.dashboard', [
            'no_customers' => $no_customers,
            'no_rooms'=>$no_rooms,
            'no_reservations'=>$no_reservations,
            'reservations'=>$reservations,
            'rooms'=>$rooms,
            'sumOfProfit'=>$sumOfProfit
        ]);
    }

    public function indexRooms(){

        $rooms = Room::get();
        return view('admin.rooms.index',[
            'rooms'=>$rooms
        ]);

    }

    public function editRoom($room_id){

        $room = room::where('room_id','=',$room_id)->first();
        $branches = Branch::get();
        $types = RoomType::get();
        return view('admin.rooms.edit',[
            'room'=>$room,
            'branches'=>$branches,
            'types'=>$types
        ]);

    }

    public function updateRoom(Request $request, $room_id){

        $this->validate($request,[
            'room_id'=>'required|alpha_num',
            'tv'=>'required',
            'refrigerator'=>'required|alpha_num',
            'view'=>'required|alpha',
            'price'=>'required|numeric'
        ]);

        $room = Room::where('room_id','=',$room_id)->first();
        $room->room_id = $request->input('room_id');
        $room->tv = $request->input('tv');
        $room->refrigerator = $request->input('refrigerator');
        $room->view = $request->input('view');
        $room->price = $request->input('price');
        if(!is_null($request->input('type'))){
            $room->type = $request->input('type');
            }
        if(!is_null($request->input('branchNo'))){
            $room->branchNo = $request->input('officeNo');
            }




        if($request->hasFile('image')){
            unlink(public_path('images'.$room->image));
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('images/',$fileName);
            $room->image = $fileName;
        }

        $room->save();

        return redirect()->back()->with('status','Room Edited Successfully');
    }

    public function deleteRoom($room_id){

        $room = Room::where('room_id','=',$room_id)->first();

        $room->delete();
        return redirect('/admin/rooms')->with('status','Room Deleted Successfullly');

    }


    public function makeAvailable($room_id){
        $room = Room::where('room_id','=',$room_id)->first();

        $room->status = 1;
        $room->save();
        
        return redirect()->back()->with('status','Room Status Changed Successfully');
    }

    public function makeUnavailable($room_id){
        $room = Room::where('room_id','=',$room_id)->first();

        $room->status = 0;
        $room->save();

        return redirect()->back()->with('status','Room Status Changed Successfully');
    }

    public function createRoom(){

        $branches = Branch::get();
        $types = RoomType::get();

        return view('admin.rooms.create',[
            'branches'=>$branches,
            'types'=>$types
        ]);

    }

    public function storeRoom(Request $request){

            $this->validate($request,[
                'room_id'=>'required|alpha_num',
                'view'=>'required|alpha',
                'refrigerator'=>'alpha_num',
                'tv'=>'required',
                'type'=>'required',
                'branch'=>'required'
            ]);
    
            $room = new room();
            
            $room->room_id = $request->input('room_id');
            $room->view = $request->input('view');
            $room->refrigerator = $request->input('model');
            $room->tv = $request->input('tv');
            $room->price = $request->input('price');
            $room->type = $request->input('type');
            $room->branchNo = $request->input('branchNo'); 
            $room->status = 1;
    
    
    
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = time().'.'.$extension;
                $file->move('images/',$fileName);
                $room->image = $fileName;
            }
            else{
                $room->image = 'room.jpg';
            }
    
            $room->save();
    
            return redirect()->back()->with('status','Room Added Successfully');
        }

    public function indexReservations(){

        $reservations = Reservation::get();
        return view('admin.reservations.index',[
            'reservations'=>$reservations
        ]);
    }

    


}
