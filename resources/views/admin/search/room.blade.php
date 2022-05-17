@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-inbox bg-blue"></i>
                <div class="d-inline">
                    <h5>Reservations</h5>
                    <span>Room Id: {{$room->room_id}} </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/admin/search/rooms">Search</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Index</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        @if(Session::has('status'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('status')}}
            </div>
        @endif
        <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <img class="img" src="{{ asset('images/'.$room->image) }}" alt="room" width="250px" height="200px" style="border-radius: 15%;">
                </div>
                <div class="col-md-3">
                    Room ID: {{$room->room_id}}<br>
                    Type: {{$room->type}}<br>
                    View: {{$room->view}} View<br>
                    Branch: {{$room->branchNo}}<br>
                </div>
                <div class="col-md-3">
                    TV: {{$room->TV}}<br>
                    Refrigeratoor: {{$room->refrigerator}}<br>
                    @if($room->status == 1)
                    Status: Available<br>
                    @else
                    Status: Maintenance<br>
                    @endif
                    Price: {{$room->price}}<br>
                </div>
                </div>
            </div>
            <div class="card-body">
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>Res ID</th>
                            <th>Room ID</th>
                            <th>Guest ID</th>
                            <th>Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <!-- <th class="nosort">&nbsp;</th>
                            <th class="nosort">&nbsp;</th>
                            <th class="nosort">&nbsp;</th> -->
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($reservations)>0)
                        @foreach($reservations as $reservation)
                        <tr>
                            <td>{{$reservation->res_id}}</td>
                            <td>{{$reservation->room_id}}</td>
                            <td>{{$reservation->user_id}}</td>
                            <th>{{$reservation->total_amount}}</th>
                            <th>{{$reservation->start_date}}</th>
                            <td>{{$reservation->end_date}}</td>
                            <td>{{$reservation->location}}</td>
                        </tr>
                        @endforeach
                        @else
                        <td>No Reseravtions To Display</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection