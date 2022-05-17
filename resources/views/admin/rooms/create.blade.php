@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Rooms</h5>
                    <span>Add Room</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="/admin/rooms">Room</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="role justify-content-center">
    <div class="col-lg-10">
        @if(Session::has('status'))
        <div class="alert bg-success alert-success text-white" role="alert">
            {{Session::get('status')}}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Add Room</h3>
            </div>
            <div class="card-body">
                <form class="forms-sample" action="/admin/rooms/add" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Room ID</label>
                                <input type="text" name="room_id" class="form-control @error('room_id') is-invalid @enderror"
                                    placeholder="Room Id" value="{{old('room_id')}}">
                                @error('room_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">View</label>
                                <input type="text" name="view"
                                    class="form-control @error('view') is-invalid @enderror" placeholder="view"
                                    value="{{old('view')}}">
                                @error('view')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">TV</label>
                                <input type="text" name="tv"
                                    class="form-control @error('tv') is-invalid @enderror" placeholder="tv" value="{{old('tv')}}">
                                @error('tv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Refigerator</label>
                                <input type="text" name="refigerator"
                                    class="form-control @error('refigerator') is-invalid @enderror"
                                    placeholder="refigerator" value="{{old('refigerator')}}">
                                @error('refigerator')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="integer" name="price" class="form-control @error('price') is-invalid @enderror"
                                    placeholder="price" value="{{old('price')}}">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Type</label>
                            <select class="form-control" name="type" value="{{old('type')}}">
                                <option value="" disabled selected>Please select</option>
                                @foreach($types as $type)
                                    <option value="{{$type->type}}"> {{$type->type}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Branch Number</label>
                            <select class="form-control" name="branchNo" value="{{old('branchNo')}}">
                                <option value="" disabled selected>Please select</option>
                                @foreach($branches as $branch)
                                    <option value="{{$branch->branchNo}}"> {{$branch->branchNo}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file"
                                    class="form-control file-upload-info @error('image') is-invalid @enderror"
                                    placeholder="Upload Image" name="image">
                                <span class="input-group-append"></span>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span class="input-group-append">
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                        Submit
                    </button>
                    <a href="{{url()->previous()}}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection