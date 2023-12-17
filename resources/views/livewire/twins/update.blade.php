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
                                        <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="storeTwins()" type="button" >Next</button>
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

