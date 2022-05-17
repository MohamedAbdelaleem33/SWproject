@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-inbox bg-blue"></i>
                <div class="d-inline">
                    <h5>Rooms</h5>
                    <span>List of all Rooms</span>
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
                        <a href="/admin/rooms">Rooms</a>
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
            <div class="card-header"><h3>Data Table</h3></div>
            <div class="card-body">
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>Room Id</th>
                            <th class="nosort">Image</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="nosort">&nbsp;</th>
                            <th class="nosort">&nbsp;</th>
                            <th class="nosort">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($rooms)>0)
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{$room->room_id}}</td>
                            <td><img src="{{asset('images/'.$room->image)}}" class="table-user-thumb" alt=""></td>
                            <td>{{$room->type}}</td>
                            <td>{{$room->price}}</td>
                            @if($room->status==1)
                            <td>Available</td>
                            @else
                            <td>Maintanence</td>
                            @endif
                            <td>
                                <div class="table-actions">
                                <a href="#" data-toggle="modal" data-target="#availability{{$room->room_id}}"><i class="ik ik-user"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#infoModal{{$room->room_id}}"><i class="ik ik-eye"></i></a>
                                    <a href="/admin/rooms/edit/{{$room->room_id}}"><i class="ik ik-edit-2"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{$room->room_id}}"><i class="ik ik-trash-2"></i></a>
                                </div>
                            </td>
                        </tr>
                        @include('admin.rooms.infoModal')
                        @include('admin.rooms.deleteModal')
                        @include('admin.rooms.availabilityModal')





                        @endforeach
                        @else
                        <td>No Cars To Display</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection