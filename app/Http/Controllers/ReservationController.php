<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Branch;

use Illuminate\Validation\Concerns\FilterEmailValidation;

class ReservationController extends Controller
{


    public function delete(Request $request, $res_id){
        $reservation = Reservation::where('res_id','=',$res_id)->first();

        $reservation->delete();
        return redirect()->back()->with('status','Cancelled Successfully');

    }

    public function reserve($id,$pickupDate,$dropoffDate,$location,$numOfDays){

        $reservation = new Reservation();
        $reservation->start_date = $pickupDate;

        $getResId = Reservation::count();

        $reservation->res_id = $getResId+1;
        $reservation->end_date = $dropoffDate;
        $reservation->location = $location;

        $roomSelected = Room::where('room_id','=',$id)->first();
        $reservation->total_amount = $roomSelected->price* $numOfDays;
        $reservation->room_id = $id;

        $user = auth()->user();

        $custumer = Customer::where('user_id','=',$user->id)->first();

        $reservation->SSN = $custumer->SSN;
        $reservation->user_id = $user->id;
        $reservation->paid = 0;
        $reservation->save();

        $locations = Branch::groupby('location')->pluck('location');


        // return redirect()->back()->with('status','Reserved Successfully');
        return redirect('/home')->with('status','Reserved Successfully');

    }

    public function datePicker(Request $request){

        $this->validate($request,[
            'location'=>'required|regex:/^[\pL\s\-]+$/u',
            'pickupDate'=>'required',
            'dropoffDate'=>'required'
        ]);

        
        $views = Room::groupBy('view')->pluck('view');
        $tvs = Room::groupBy('TV')->pluck('TV');
        $refrigerators = Room::groupBy('refrigerator')->pluck('refrigerator');
        $types = Room::groupBy('type')->pluck('type');

        $pickupDate = $request->input('pickupDate');
        $dropoffDate = $request->input('dropoffDate');
        $location = $request->input('location');


        $reservations = Reservation::where([
            ['start_date','<=',$dropoffDate],
            ['start_date','>=',$pickupDate]
        ])->orWhere([
            ['end_date','>=',$pickupDate],
            ['end_date','<=',$dropoffDate]
        ])
        ->orWhere([
            ['start_date','<=',$pickupDate],
            ['end_date','>=',$dropoffDate]
        ])->pluck('room_id');

        $branch = Branch::where('location','=',$location)->pluck('branchNo');

        $rooms = Room::whereNotIn('room_id',$reservations)
        ->whereIn('branchNo',$branch)
        ->where('status','=',1)
        ->get();

        $pickupDate2 = \Carbon\Carbon::parse($request->input('pickupDate'));
        $dropoffDate2 = \Carbon\Carbon::parse($request->input('dropoffDate'));

        $numOfDays = $dropoffDate2->diffInDays($pickupDate2);
        
        return view('roomList',[
            'rooms'=>$rooms,
            'views'=>$views,
            'filteredViews'=>$views,
            'tvs'=>$tvs,
            'refrigerators'=>$refrigerators,
            'types'=>$types,
            'filteredTvs'=>$tvs,
            'filteredRefrigerators'=>$refrigerators,
            'filteredTypes'=>$types,
            'pickupDate'=>$pickupDate,
            'dropoffDate'=>$dropoffDate,
            'location'=>$location,
            'numOfDays'=>$numOfDays
        ]);

    }

    public function filter(Request $request,$pickupDate,$dropoffDate,$location,$numOfDays)
    {
        //Filter according to filled checkboxes
        $views = Room::groupBy('view')->pluck('view');

        $i = 0;
        $filteredViews=null;
        foreach($views as $view){
            if($request->input($view)){
            $filteredViews[$i]=$view;
            }
            $i++; 
        }
        $i = 0;
        if($filteredViews==null){
            foreach($views as $view){
                $filteredViews[$i]=$view;
                $i++; 
            }
        }
        $filteredViews = Room::whereIn('view',$filteredViews)->groupBy('view')->pluck('view');

        $tvs = Room::groupBy('tv')->pluck('tv');
        $i = 0;
        $filteredTvs=null;
        foreach($tvs as $tv){
            if($request->input($tv)){
            $filteredTvs[$i]=$tv;
            }
            $i++; 
        }
        $i = 0;
        if($filteredTvs==null){
            foreach($tvs as $tv){
                $filteredTvs[$i]=$tv;
                $i++; 
            }
        }
        $filteredTvs = Room::whereIn('tv',$filteredTvs)->groupBy('tv')->pluck('tv');

        $refrigerators = Room::groupBy('refrigerator')->pluck('refrigerator');
        $i = 0;
        $filteredRefrigerators=null;
        foreach($refrigerators as $refrigerator){
            if($request->input($refrigerator)){
            $filteredRefrigerators[$i]=$refrigerator;
            }
            $i++; 
        }
        $i = 0;
        if($filteredRefrigerators==null){
            foreach($refrigerators as $refrigerator){
                $filteredRefrigerators[$i]=$refrigerator;
                $i++; 
            }
        }
        $filteredRefrigerators = Room::whereIn('refrigerator',$filteredRefrigerators)->groupBy('refrigerator')->pluck('refrigerator');

        $types = Room::groupBy('type')->pluck('type');
        $i = 0;
        $filteredTypes=null;
        foreach($types as $type){
            if($request->input($type)){
            $filteredTypes[$i]=$type;
            }
            $i++; 
        }
        $i = 0;
        if($filteredTypes==null){
            foreach($types as $type){
                $filteredTypes[$i]=$type;
                $i++; 
            }
        }
        $filteredTypes = Room::whereIn('type',$filteredTypes)->groupBy('type')->pluck('type');

        //Get Available Rooms
        $reservations = Reservation::where([
            ['start_date','<=',$dropoffDate],
            ['start_date','>=',$pickupDate]
        ])->orWhere([
            ['end_date','>=',$pickupDate],
            ['end_date','<=',$dropoffDate]
        ])
        ->orWhere([
            ['start_date','<=',$pickupDate],
            ['end_date','>=',$dropoffDate]
        ])->pluck('room_id');

        $branch = Branch::where('location','=',$location)->pluck('branchNo');

        $rooms = Room::whereNotIn('room_id',$reservations)
        ->whereIn('branchNo',$branch)
        ->whereIn('tv',$filteredTvs)
        ->whereIn('view',$filteredViews)
        ->whereIn('refrigerator',$filteredRefrigerators)
        ->whereIn('type',$filteredTypes)
        ->where('status','=',1)
        ->get();

        if($rooms == null){
            return redirect('/home')->with('status','No Matches Found');
        }

        return view('roomList',[
            'rooms'=>$rooms,
            'views'=>$views,
            'filteredViews'=>$views,
            'tvs'=>$tvs,
            'refrigerators'=>$refrigerators,
            'types'=>$types,
            'filteredTvs'=>$tvs,
            'filteredRefrigerators'=>$refrigerators,
            'filteredTypes'=>$types,
            'pickupDate'=>$pickupDate,
            'dropoffDate'=>$dropoffDate,
            'location'=>$location,
            'numOfDays'=>$numOfDays
        ]);    
    }
}
