<!-- Modal -->
<div class="modal fade" id="availability{{$room->room_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="availabilityModalLabel">Room Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>
            <p>Are you sure you want to change status ?</p>
        </p>
      </div>
      <div class="modal-footer">
      <form action="/admin/rooms/status/available/{{$room->room_id}}" enctype="multipart/form-data" method="POST">
                @csrf
                <button type="sumbit" class="btn btn-danger">Available</button>
            </form>
            <form action="/admin/rooms/status/unAvailable/{{$room->room_id}}" enctype="multipart/form-data" method="POST">
                @csrf
                <button type="sumbit" class="btn btn-danger">Maintenance</button>
            </form>
        
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>