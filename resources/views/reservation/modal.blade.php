<!-- Modal -->
<div class="modal" id="roomModal{{$room->room_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Room Information</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3  style="color:blue;"><img src="{{ asset('images/'.$room->image) }}" width="250px" height="150px"
                                            alt="Image" class="img myimg"></h3>
                <p class="badge badge-pill badge-primary" style="font-size:1.2rem;border-radius:15px;">{{$room->view}} View</p>
                <p  style="color:blue;">Type: {{$room->type}}</p>
                <p style="color:blue;">No of Guests: {{$room->RoomType->no_guests}}</p>
                <p style="color:blue;">No of Beds: {{$room->RoomType->no_beds}}</p>
                <p style="color:blue;">TV: {{$room->TV}}</p>
                <p style="color:blue;">Regrigerator: {{$room->refrigerator}}</p>
                <p style="color:blue;">Pickup Date: {{$pickupDate}}</p>
                <p style="color:blue;">Droppoff Date: {{$dropoffDate}}</p>
                <p style="color:blue;">Location: {{$location}}</p>
      </div>      
      <div class="modal-footer">
            <form action="/reserve/{{$room->room_id}}/{{$pickupDate}}/{{$dropoffDate}}/{{$location}}/{{$numOfDays}}" enctype="multipart/form-data" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" style="border-radius:15px;">Confirm Reservation</button>
            </form>
            <button type="button" class="btn btn-primary" data-dismiss="modal"  style="border-radius:15px;">Close</button>
      </div>
    </div>
  </div>
</div>