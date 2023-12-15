<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Update {{$title}} Twin :</h6>
                    </div>
                </div>
                

                <div class="card-body px-0 pb-2">
                    

                    
                        <div class="stepwizard p-2 ">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                                    <p>1- Knolage Base</p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                                    <p>2- Instructions</p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">3</a>
                                    <p>3- Test</p>
                                </div>
                            </div>
                        </div>
                    
                        <div class="p-2  row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <!-- <h3> Step 1</h3> -->
                    
                                    <div class="form-group">
                                        <label for="title">Twin Title:</label>
                                        <input type="text" wire:model="title" class="form-control" id="title">
                                        @error('title') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    
                    
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="editTwins({{$this->id}})" type="button" >Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h3> Step 2</h3>
                    
                                    
                    
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
                                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h3> Step 3</h3>
                                    {{--
                                    <table class="table">
                                        <tr>
                                            <td>Product Name:</td>
                                            <td><strong>{{$name}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Product Amount:</td>
                                            <td><strong>{{$amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Product status:</td>
                                            <td><strong>{{$status ? 'Active' : 'DeActive'}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Product Description:</td>
                                            <td><strong>{{$description}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Product Stock:</td>
                                            <td><strong>{{$stock}}</strong></td>
                                        </tr>
                                    </table>
                                    --}}
                    
                                    <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
                                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
                                </div>
                            </div>
                        </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>





<div class="card">
    <div class="card-body">
        <form>
            <div class="form-group mb-3">
                <label for="title">Title: {{$title}}</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Title" wire:model="twin.title">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="d-grid gap-2">
                <button wire:click.prevent="updatePost()" class="btn btn-success btn-block">Update</button>
                <button wire:click.prevent="cancelPost()" class="btn btn-secondary btn-block">Cancel</button>
            </div>
        </form>
    </div>
</div>




  