<div>
    <div class="container">
        <div class="card mt-5">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                <a href="{{route('packages')}}"class="btn btn-info">Back</a>
                </div>

            </div>
            @include('livewire.package.message')
            <div class="modal-body">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Title</label>
                  <input type="text" class="form-control" wire:model="title" disabled>
                  @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">price</label>
                  <input type="number" class="form-control" wire:model="price" disabled>
                  @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Class Name</label>
                  <input type="text" class="form-control" wire:model="class_name" disabled>
                  @error('class_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Discount</label>
                  <input type="number" class="form-control" wire:model="discount" disabled>
                  @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Dscription</label>
                  <textarea class="form-control" wire:model="description"></textarea disabled>
                  @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
          </div>

          </div>

    </div>
</div>
