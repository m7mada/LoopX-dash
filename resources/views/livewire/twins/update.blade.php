<div class="card">
    <div class="card-body">
        <form>
            <div class="form-group mb-3">
                <label for="title">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Title" wire:model="title">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-grid gap-2">
                <button wire:click.prevent="updateTwins()" class="btn btn-success btn-block">Update</button>
                <button wire:click.prevent="cancelTwins()" class="btn btn-secondary btn-block">Cancel</button>
            </div>
        </form>
    </div>
</div>