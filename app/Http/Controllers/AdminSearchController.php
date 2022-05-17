<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Customer;




class AdminSearchController extends Controller
{
    //
    public function searchRooms(){

        $rooms = Room::get();
        return view('admin.search.rooms',[
            'rooms'=>$rooms
        ]);
    }

    public function showFilteredRooms($room_id){

        $reservations = Reservation::where('room_id','=',$room_id)->get();
        $reseravtionsXrooms = Reservation::join('rooms','rooms.room_id','=','reservations.room_id')->get()
        ->where('room_id','=',$room_id)->first();
        //If room not reserved
        $roomSearched = Room::where('room_id','=',$room_id)->first();
        return view('admin.search.room',[
            'reservations'=>$reservations,
            'room'=>$roomSearched
        ]);

    }
    public function searchCustomers(){

        $customers = Customer::get();
        return view('admin.search.customers',[
            'customers'=>$customers
        ]);
    }

    public function showFilteredCustomer($user_id){

        $reservations = Reservation::where('user_id','=',$user_id)->get();
        $reseravtionsXcustomers = Reservation::join('customers','customers.user_id','=','reservations.user_id')->get()
        ->where('user_id','=',$user_id)->first();
        return view('admin.search.customer',[
            'reservations'=>$reservations,
            'customer'=>$reseravtionsXcustomers
        ]);

    }

    public function searchReservations(){

        return view('admin.search.reservations');
    }

    public function showFilteredReservations(Request $request){
        $pickDate = $request->input('pickupDate');

        $reservations = Reservation::where('start_date','=',$pickDate)->get();
        // $reseravtionsXcustomers = Reservation::join('customers','customers.user_id','=','reservations.user_id')->get()
        // ->where('user_id','=',$user_id)->first();
        return view('admin.search.reservation',[
            'reservations'=>$reservations,
            'pickupDate'=>$pickDate
        ]);

    }

    public function searchAvailable(){

        return view('admin.search.availabilities');
    }

    public function showFilteredAvailable(Request $request){
        $pickDate = $request->input('pickupDate');

        $reservations = Reservation::where('start_date','=',$pickDate)->get();
        $rooms = Room::get();
        // $reseravtionsXcustomers = Reservation::join('customers','customers.user_id','=','reservations.user_id')->get()
        // ->where('user_id','=',$user_id)->first();
        return view('admin.search.availability',[
            'reservations'=>$reservations,
            'pickupDate'=>$pickDate,
            'rooms'=>$rooms
        ]);

    }   

}
