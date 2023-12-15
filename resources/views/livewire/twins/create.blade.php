<a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#create-twin-form"><i class="material-icons text-sm">add</i>&nbsp;&nbsp; New Twin</a>

<div class="col-md-4">
    <div class="modal fade" wire:ignore.self id="create-twin-form" tabindex="-1" role="dialog" aria-labelledby="create-twin-form-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="create-twin-form-lable">Create an new AI-Twin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form role="form text-left">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Name</label>
                                <input type="text" wire:click.prevent="" class="form-control @error('title') is-invalid @enderror" wire:model="title" onfocus="focused(this)" onfocusout="defocused(this)">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="text-center">
                                <button type="button" wire:click.prevent="storeTwins();" class="btn btn-round bg-gradient-info btn-lg w-40 mt-4 mb-0">Add Twin</button>
                                <button type="button" wire:click.prevent="cancelTwins();" class="btn btn-round  btn-lg w-40 mt-4 mb-0 bg-gradient-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
