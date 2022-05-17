<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="infoModal{{$room->room_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Room Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
            <img src="{{ asset('images/'.$room->image) }}" width="250px" height="200px" alt="Image" class="img myimg"><br>
            <p class="badge badge-pill badge-primary">{{$room->type}}</p>
            <p class="badge badge-pill badge-primary">{{$room->view}} View</p>
            @if($room->TV)
              <p class="badge badge-pill badge-primary">TV</p>
            @endif
            @if($room->refrigerator)
              <p class="badge badge-pill badge-primary">Refrigerator</p>
            @endif
            <p>No of Guests: {{$room->RoomType->no_guests}}</p>
            <p>No of Beds: {{$room->RoomType->no_beds}}</p>
            <p>Price: {{$room->price}}</p>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>