@extends('layouts.app')

@section('content')


  

<div class="sidenav">
    <div>
        <form method="POST"  action="/rooms/{{$pickupDate}}/{{$dropoffDate}}/{{$location}}/{{$numOfDays}}" enctype="multipart/form-data">
        @csrf
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Type
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        @foreach($types as $type)
                            <label class="containercheckbox">{{$type}}
                                @php($flag=0)
                                @foreach($filteredTypes as $filteredType)
                                    @if($type == $filteredType)
                                        @php($flag=1)
                                    @endif
                                @endforeach
                                @if($flag==1)
                                    <input id="checkbox" type="checkbox" name="{{$type}}" checked="true">
                                @else
                                <input id="checkbox" type="checkbox" name="{{$type}}">
                                @endif
                            <span class="checkmark"></span>
                            </label>
                        @endforeach
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        View
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        @foreach($views as $view)
                            <label class="containercheckbox">{{$view}}
                                @php($flag=0)
                                @foreach($filteredViews as $filteredView)
                                    @if($view == $filteredView)
                                        @php($flag=1)
                                    @endif
                                @endforeach
                                @if($flag==1)
                                    <input id="checkbox" type="checkbox" name="{{$view}}" checked="true">
                                @else
                                <input id="checkbox" type="checkbox" name="{{$view}}">
                                @endif
                            <span class="checkmark"></span>
                            </label>
                        @endforeach                   
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        TV
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        @foreach($tvs as $tv)
                            <label class="containercheckbox">{{$tv}}
                                @php($flag=0)
                                @foreach($filteredTvs as $filteredTv)
                                    @if($tv == $filteredTv)
                                        @php($flag=1)
                                    @endif
                                @endforeach
                                @if($flag==1)
                                    <input id="checkbox" type="checkbox" name="{{$tv}}" checked="true">
                                @else
                                <input id="checkbox" type="checkbox" name="{{$tv}}">
                                @endif
                            <span class="checkmark"></span>
                            </label>
                        @endforeach                     
                    </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                        Refrigerator
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                    <div class="accordion-body">
                        @foreach($refrigerators as $refrigerator)
                            <label class="containercheckbox">{{$refrigerator}}
                                @php($flag=0)
                                @foreach($filteredRefrigerators as $filteredRefrigerator)
                                    @if($refrigerator == $filteredRefrigerator)
                                        @php($flag=1)
                                    @endif
                                @endforeach
                                @if($flag==1)
                                    <input id="checkbox" type="checkbox" name="{{$refrigerator}}" checked="true">
                                @else
                                <input id="checkbox" type="checkbox" name="{{$refrigerator}}">
                                @endif
                            <span class="checkmark"></span>
                            </label>
                        @endforeach                   
                    </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" value="submit" id="submit" style="margin:10px;">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Choose Your Room</h1>
                    <div>
                        @if(count($rooms)>0)
                        @foreach($rooms as $room)
                        <div class="container myContainer p-4">
                                <div class="row-md-4">
                                    <div class="col-md-4">
                                        <img src="{{ asset('images/'.$room->image) }}" width="250px" height="150px" alt="Image" class="myimg">
                                    </div>
                                    <div class="col-md-4">
                                        <p>{{$room->type}}</p>
                                        <p>{{$room->view}} View</p>
                                        <p> asd</p>
                                    </div>
                                </div>
                                <p>Price Per Day: {{$room->price}}</p>
                                <p>Price: {{$room->price*$numOfDays}}</p>
                            <a  href="#" data-toggle="modal" data-target="#roomModal{{$room->room_id}}">
                                <button class="btn btn-primary" type="submit" value="submit" id="submit">Reserve</button>
                            </a>
                        </div>
                        @include('reservation.modal')
                        @endforeach
                        @else
                        <p>No Matches Found</p>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
