<div>
    <div class="container-fluid py-4">
        <div class="row">
            @include('livewire.pakedge.message')

            <div class="col-12">
                <div class="card my-4">
                    <div class=" me-3 my-3 text-end">
                        <a class="btn bg-gradient-dark mb-0" href="{{ route('user-management') }}"><i
                                class="material-icons text-sm"></i>&nbsp;&nbsp;Back</a>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" wire:model="name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" wire:model="email">
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">password</label>
                                        <input type="text" class="form-control" wire:model="password">
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">location</label>
                                        <input type="text" class="form-control" wire:model="location">
                                    </div>
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">phone</label>
                                        <input type="text" class="form-control" wire:model="phone">
                                    </div>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">about</label>
                                        <textarea class="form-control" wire:model="about"></textarea>
                                    </div>
                                    @error('about')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button wire:click="update()" class="btn bg-gradient-primary">update</button>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

