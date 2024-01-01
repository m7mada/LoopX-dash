

<style>
    .stepwizard-row:before{
        top: 22px;
    }
</style>




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
                <div class="card-body px-4 pb-2">
                    <div class="stepwizard p-2 ">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" wire:click="$set('currentStep', '1')" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-secondary' : 'btn-primary' }}">1</a>
                                <p>1- Setting</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" wire:click="$set('currentStep', '2')" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-secondary' : 'btn-primary' }}">2</a>
                                <p>2- Knolage Base</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" wire:click="$set('currentStep', '3')" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-secondary' : 'btn-primary' }}">3</a>
                                <p>3- Instructions</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-4" wire:click="$set('currentStep', '4')" type="button" class="btn btn-circle {{ $currentStep != 4 ? 'btn-secondary' : 'btn-primary' }}" disabled="disabled">4</a>
                                <p>4- Test</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 p-2 row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h4 class="mb-3"> Step 1 : Set the Twin Settings</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline mb-4">
                                                <label for="title" class="form-label">Twin Title:</label>
                                                <input type="text" id="title" wire:model.defer="model.title" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <div class="form-check form-switch">
                                                    <input wire:model.defer="model.is_active" class="form-check-input" type="checkbox" id="is_active" @if ($this->model->is_active == 1 ) checked="1" @endif>
                                                    <label class="form-check-label" for="is_active">Active {{$this->model->is_active}}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <label for="kb_model_name" class="ms-0">Model :</label>
                                                <div class="input-group input-group-outline">
                                                    <select class="form-control" id="kb_model_name" wire:model.defer="model.kb_model_name">
                                                        <option value="gpt-3.5-turbo-1106" selected>Twin</option>
                                                        <option value="gpt-4-1106-preview">Twin Pro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>




                                        <!-- <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <label for="msgs_model_name" class="ms-0">Message Model Name</label>
                                                <div class="input-group input-group-outline">
                                                    <select class="form-control" id="msgs_model_name" wire:model.defer="model.msgs_model_name">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> -->

                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <label for="agent_dialect" class="ms-0">Agent Dialect</label>
                                                <div class="input-group input-group-outline">
                                                    <select class="form-control" wire:model.defer="model.agent_dialect">
                                                        <option value="Egyptian Colloquial Arabic - اللهجة العامية المصرية" selected>Egyptian Colloquial Arabic - اللهجة العامية المصرية</option>
                                                        <option value="Saudi Arabic - اللهجة السعودية">Saudi Arabic - اللهجة السعودية</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <label for="user_dialect" class="ms-0">User Dialect</label>
                                                <div class="input-group input-group-outline">
                                                    <select class="form-control" wire:model.defer="model.user_dialect">
                                                        <option value="English">English</option>
                                                        <option value="Arabic" selected>Arabic</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>


                                @if( $addTwins )
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="insertTwins()" type="button" >Next</button>
                                @else
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="px-4 p-2 row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h4 class="mb-3">Step 2: Upload your files </h4>

                                <div class="mb-3 p-3" style="border: 2px dashed #ddd;">
                                    <div class="fallback">
                                        <input wire:model="newFiles" name="file" type="file" multiple />
                                    </div>
                                </div>

                                <div style="width:100%" wire:loading class="mb-3 p-3">
                                    <div wire:loading class="spinner-border" role="status"></div>Loading...
                                </div>


                                @foreach($files as $file)
                                    <div class="dz-preview dz-processing dz-image-preview dz-complete">
                                        <div class="dz-details">
                                            <div class="dz-thumbnail">
                                                <img data-dz-thumbnail=""
                                                    alt="logo.svg"
                                                    src="{{$file['path']}}">
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
                    <div class="px-4 p-2 row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h4 class="mb-3"> Step 3</h4>
                                    <div class="col-xs-12 mb-3">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-outline">
                                                <textarea class="form-control" wire:model="model.agent_persona" rows="5" placeholder="Say a few words about your agent persona." spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 mb-3">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-outline">
                                                <textarea class="form-control" wire:model="model.agent_instructions" rows="5" placeholder="Say a few words as an instructions for your agent." spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 mb-3">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-outline">
                                                <textarea class="form-control" wire:model="model.example_messages" rows="5" placeholder="Say a few examples for your agent." spellcheck="false"></textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button>
                                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="$set('currentStep', '2')">Back</button>
                                </div>
                            </div>
                    </div>

                    <div class="px-4 p-2 row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
                            <div class="col-xs-12">
                            <iframe
                            style="width: 500px;height: 600px;margin: auto;display: block;"
                            
                                srcdoc='
                            
                                <!DOCTYPE html>
                                <html>
                                <head>
                                <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
                                <script src="https://mediafiles.botpress.cloud/caa58dcf-151f-4811-b8c3-d69e9099f9ae/webchat/config.js" defer></script>
                                </head>
                                    <body>

                                        <script>
                                            console.log(window.botpressWebChat)
                                            window.botpressWebChat.init({
                                                <!-- "composerPlaceholder": "Chat with bot",
                                                "botConversationDescription": "This chatbot was built surprisingly fast with Botpress", -->
                                                "botId": "c4b9f9b1-525d-435e-a745-d57fc5445e06",
                                                "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
                                                "messagingUrl": "https://messaging.botpress.cloud",
                                                "clientId": "c4b9f9b1-525d-435e-a745-d57fc5445e06",
                                                "webhookId": "73c5dd0d-30e8-4e0e-b099-11acd75375ca",
                                                <!-- "lazySocket": true,
                                                "themeName": "prism",
                                                "frontendVersion": "v1",
                                                "showPoweredBy": true,
                                                "theme": "prism",
                                                "themeColor": "#2563eb",
                                                "className": "botpress",
                                                "showCloseButton": false,
                                                "showConversationsButton": false -->
                                            })

                                            window.botpressWebChat.sendEvent({ type: 'show' })
                                        </script>

                                    </body>
                                </html>
                            
                            ' name="iframe_a" title="Iframe Example"></iframe>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



