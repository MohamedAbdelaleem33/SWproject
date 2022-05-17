@extends('layouts.app')

@section('content')

<div class="container">
    <h1  style="color:blue; text-align:center;">My Reservations</h1>
    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                @foreach($reservations as $reservation)
                    <div class="container myContainer p-4">
                    <div class="row-md-4">
                        <div class="col-md-4">
                    <img src="{{ asset('images/'.$reservation->image) }}" width="250px" height="150px" alt="Image" class="myimg">
                        </div>
                            <div class="col-md-4">
                                <h3>Type: {{$reservation->type}}</h3>
                                <p>Room No: {{$reservation->room_id}}</p>
                                <p>Location: {{$reservation->location}}</p>
                                <p>Date: {{$reservation->start_date}} to {{$reservation->end_date}}</p>
                            </div>
                        <a  href="#" data-toggle="modal" data-target="#roomModal{{$reservation->res_id}}">
                            <button class="btn btn-primary" type="submit" value="submit" id="submit">View Reservation</button>
                        </a>
                    </div>
                    </div>
                    @include('customer.modal')
                @endforeach                              
            </div>
        </div>
    </div>
</div>
@endsection

