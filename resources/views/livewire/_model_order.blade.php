 <!-- Modal -->
 <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Pakedge Name : {{$item->title}} {{$item->id}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('store.order')}}" method="post">
        <div class="modal-body">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">phone</label>
                    <input type="number" class="form-control" name="phone">
                </div>
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror

                <div class="input-group input-group-outline my-3">
                    <input type="hidden" value="{{$item->id}}"  class="form-control"name="pakedge_id">
                </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn bg-gradient-primary">Save</button>
        </div>
    </form>
      </div>
    </div>
  </div>
