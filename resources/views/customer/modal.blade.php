<!-- Modal -->
<div class="modal" id="roomModal{{$reservation->res_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Room Information</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3  style="color:blue;"><img src="{{ asset('images/'.$reservation->image) }}" width="250px" height="150px"
                                            alt="Image" class="img myimg"></h3>
                <p class="badge badge-pill badge-primary" style="font-size:1.2rem;border-radius:15px;">{{$reservation->view}} View</p>
                <p  style="color:blue;">Type: {{$reservation->type}}</p>
                <p style="color:blue;">No of Guests: {{$reservation->no_guests}}</p>
                <p style="color:blue;">No of Beds: {{$reservation->no_beds}}</p>
                <p style="color:blue;">TV: {{$reservation->TV}}</p>
                <p style="color:blue;">Regrigerator: {{$reservation->refrigerator}}</p>
                <p style="color:blue;">Pickup Date: {{$reservation->start_date}}</p>
                <p style="color:blue;">Droppoff Date: {{$reservation->end_date}}</p>
                <p style="color:blue;">Location: {{$reservation->location}}</p>
      </div>      
      <div class="modal-footer">
            <form action="/delete/{{$reservation->res_id}}" enctype="multipart/form-data" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" style="border-radius:15px;">Cancel Reservation</button>
            </form>
            <form action="/reservations/pay/{{$reservation->res_id}}" enctype="multipart/form-data" method="POST">
            @csrf

            @if($reservation->paid==0)
            <button type="submit" class="btn btn-primary" style="border-radius:15px;">Pay {{$reservation->total_amount}} EGP</button>
            @else
            <button type="submit" class="btn btn-primary" style="border-radius:15px;" disabled >Pay {{$reservation->total_amount}} EGP</button>
            @endif
            </form>
      </div>
    </div>
  </div>
</div>