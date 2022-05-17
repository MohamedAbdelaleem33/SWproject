<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function create(){

        // $user = auth()->user();

        // $id = $user->id;
        // $user = User::find($id);
        // $trainer = Trainer::find($id);
        return view('customer.completeProfile');
    }
    public function store(Request $request){

        // $user = auth()->user();

        // $id = $user->id;
        // $user = User::find($id);
        // $trainer = Trainer::find($id);

        $this->validate($request,[
            'fname'=>'required|regex:/^[\pL\s\-]+$/u',
            'lname'=>'required|regex:/^[\pL\s\-]+$/u',
            'ssn'=>'required|numeric',
            'phone'=>'required|numeric',
            'age'=>'required|numeric',
            'city'=>'required|alpha',
            'country'=>'required|alpha',
            'gender'=>'required'
        ]);

        $customer = new Customer();
        $customer->user_id = auth()->user()->id;
        $customer->fname = $request->input('fname');
        $customer->lname = $request->input('lname');
        $customer->SSN = $request->input('ssn');
        $customer->city = $request->input('city');
        $customer->country = $request->input('country');
        $customer->phone = $request->input('phone');
        $customer->age = $request->input('age');
        $customer->gender = $request->input('gender');

        if($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $file->move('uploads/customers/',$fileName);
            $customer->image = $fileName;
        }else{
            $customer->image = 'user.png';
        }
        $customer->save();

        return redirect('home')->with('status','Account Completed');
    }

    public function index(){

        $user = auth()->user();
        // $reservations = Reservation::where('user_id','=',$user->id)->orderBy('start_date')->get();
        $reservationsXrooms = Room::join('room_types','room_types.type','=','rooms.type')
        ->join('reservations','reservations.room_id','=','rooms.room_id')
        ->where('user_id','=',$user->id)->orderBy('start_date')->get();

        return view('customer.reservations',[
            'reservations'=>$reservationsXrooms
        ]);
    }

    public function pay($res_id){

        $reservation = Reservation::where('res_id','=',$res_id)->first();
        $reservation->paid = 1;
        $reservation->save();

        return redirect('/reservations')->with('status','Resrvation Paid Successfully');

    }

}
