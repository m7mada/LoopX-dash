

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
                                <h4 class="mb-3">Setup Your Twin:</h4>
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
                                                    <label class="form-check-label" for="is_active">Active</label>
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
                                <h4 class="mb-3">Build Your Twin Mind: </h4>

                                

                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 mt-4 mb-4">
                                        <div class="mb-3 p-3" style="border: 2px dashed #ddd;">
                                            <div class="fallback">
                                                <input wire:model="newFiles" type="file" multiple />
                                            </div>
                                        </div>

                                        <div style="width:100%" wire:loading class="mb-3 p-3">
                                            <div wire:loading class="spinner-border" role="status"></div>Loading...
                                        </div>
                                    </div>    
                                    <div class="col-lg-6 col-md-6 mt-4 mb-4">
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Attached files</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Size</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($model->files as $file)

                                                    <tr>
                                                
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{$file['name']}}</p>
                                                        <p class="text-xs text-secondary mb-0">{{$file['created_at']}}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">{{$file['size']}}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="javascript:;" wire:click.prevent="removeFile({{$file['id']}})"  class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Delete file">
                                                        Delete
                                                        </a> | 

                                                        <a target="_blank" href="{{$file['path']}}" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Delete file">
                                                        Preview
                                                        </a>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="$set('currentStep', '1')">Back</button>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button>

                            </div>
                        </div>
                    </div>
                    <div class="px-4 p-2 row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <h4 class="mb-3"> Teach Your Twin:</h4>
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

                                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="$set('currentStep', '2')">Back</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button>
                                </div>
                            </div>
                    </div>
                    <div class="px-4 p-2 row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
                            <div class="col-xs-12">
                            
                                <div class="card text-center">
                                <div class="overflow-hidden position-relative border-radius-lg bg-cover p-3" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/window-desk.jpg')">
                                    <span class="mask bg-gradient-dark opacity-6"></span>
                                    <div class="card-body position-relative z-index-1 d-flex flex-column mt-5">
                                    <p class="text-white font-weight-bolder">Chose package from billing page.</p>
                                    <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-4" href="/billing">
                                        Try Now
                                        <i class="material-icons text-sm ms-1 position-relative" aria-hidden="true">arrow_forward</i>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            {{--<iframe
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
                            
                            ' name="iframe_a" title="Iframe Example"></iframe> --}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



