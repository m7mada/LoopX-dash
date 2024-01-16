<div>
    <div class="container">
        <div class="card mt-5">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{route('packages')}}" class="btn btn-info">Back</a>
                </div>

            </div>
            @include('livewire.package.message')
            <div class="modal-body">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" wire:model.defer="title">
                </div>
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Class Name</label>
                    <input type="text" class="form-control" wire:model.defer="class_name">
                </div>
                @error('class_name') <span class="text-danger">{{ $message }}</span> @enderror
                
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Dscription</label>
                    <textarea class="form-control" wire:model.defer="description"></textarea>
                </div>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                <div class="input-group input-group-outline my-3">

                    <button class="btn bg-gradient-primary" wire:click="edit()">Edit</button>
                </div>

            </div>

        </div>

    </div>
</div>
