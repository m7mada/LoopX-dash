<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">
                            @if( $addTwins )
                              Add an AI Twin :
                            @else
                                Update {{$model->title }} Twin :
                            @endif
                            
                        </h6>
                    </div>
                </div>
                

                <div class="card-body px-0 pb-2">
                    

                    
                        <div class="stepwizard p-2 ">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="#step-1" wire:click="$set('currentStep', '1')" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                                    <p>1- Setting</p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-2" wire:click="$set('currentStep', '2')" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                                    <p>2- Knolage Base</p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-3" wire:click="$set('currentStep', '3')" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}">3</a>
                                    <p>3- Instructions</p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-4" wire:click="$set('currentStep', '4')" type="button" class="btn btn-circle {{ $currentStep != 4 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">4</a>
                                    <p>4- Test</p>
                                </div>
                            </div>
                        </div>
                    
                        <div class="p-2  row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h3> Step 1 : Set the Twin Settings</h3>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group input-group-outline mb-4">
                                                    <label for="title" class="form-label">Twin Title:</label>
                                                    <input type="text" id="title" wire:model.defer="model.title" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="kb_model_name" class="ms-0">Model Name:</label>
                                                    <select class="form-control" id="kb_model_name" wire:model.defer="model.kb_model_name">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="msgs_model_name" class="ms-0">Message Model Name</label>
                                                    <select class="form-control" id="msgs_model_name" wire:model.defer="model.msgs_model_name">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="agent_dialect" class="ms-0">Agent Dialect</label>
                                                    <select class="form-control" wire:model.defer="model.agent_dialect">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-static mb-4">
                                                    <label for="user_dialect" class="ms-0">User Dialect</label>
                                                    <select class="form-control" wire:model.defer="model.user_dialect">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    
                                    @if( $addTwins )
                                        <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="insertTwins()" type="button" >Next</button>
                                    @else
                                        <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button>                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-2 row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h3>Step 2: Upload your files </h3>
                    
                                    <div class="card">
                                        <h5 class="card-header">Multiple</h5>

                                        <div class="card-body">
                                                <div class="dz-message needsclick dropzone needsclick">
                                                    Drop files here or click to upload
                                                </div>
                                                <div class="fallback">
                                                    <input wire:model="newFiles"  name="file" type="file" multiple />
                                                </div>
                                        </div>
                                    </div>

                                    <div style="width:100%" wire:loading>
                                        <div wire:loading class="spinner-border" role="status">
                                        </div>Loading...
                                    </div>

                                    
                                    @foreach($files as $file)
                                        <div class="dz-preview dz-processing dz-image-preview dz-complete">
                                            <div class="dz-details">
                                                <div class="dz-thumbnail">
                                                    {{--<img data-dz-thumbnail=""
                                                        alt="logo.svg"
                                                        src="{{$file['path']}}">--}}
                                                    <span class="dz-nopreview">{{$file['name']}} <br> {{$file['size']}}</span>
                                                    <div class="dz-success-mark"></div>
                                                    <div class="dz-error-mark"></div>
                                                    <div class="dz-error-message">
                                                            <span data-dz-errormessage="">

                                                            </span>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress="" style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                                <div class="dz-filename" data-dz-name=""></div>
                                                <div style="padding: 0.875rem 0.625rem 0.625rem 0.625rem;" class="dz-size text-center" data-dz-size="">
                                                        <a target="_blank" href="{{$file['path']}}">Preview</a>
                                                </div>
                                            </div>
                                            <a class="dz-remove bg-danger text-white" href="javascript:undefined;" wire:click="removeFile({{$file['id']}})" data-dz-remove="">
                                                Remove file
                                            </a>
                                        </div>

                                    @endforeach
                    
                        
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button>                        
                                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="$set('currentStep', '1')">Back</button>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h3> Step 3</h3>
                                    <div class="col-xs-12">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-dynamic">
                                                <textarea class="form-control" wire:model="model.agent_persona" rows="5" placeholder="Say a few words about who you are or what you're working on." spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-dynamic">
                                                <textarea class="form-control" wire:model="model.agent_instructions" rows="5" placeholder="Say a few words about who you are or what you're working on." spellcheck="false"></textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-dynamic">
                                                <textarea class="form-control" wire:model="model.example_messagesa" rows="5" placeholder="Say a few words about who you are or what you're working on." spellcheck="false"></textarea>
                                            </div>

                                        </div>
                                    </div>
                    
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button> 
                                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="$set('currentStep', '2')">Back</button>
                                </div>
                            </div>
                        </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>

