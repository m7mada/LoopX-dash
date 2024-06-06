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
                            @if($addTwins)
                              Add an AI Twin:
                            @else
                              Update {{$model->title }} Twin:
                            @endif
                        </h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <div class="stepwizard p-2 ">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" wire:click="$set('currentStep', '1')" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-secondary' : 'btn-primary' }}">1</a>
                                <p>Configuration Settings</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" wire:click="$set('currentStep', '2')" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-secondary' : 'btn-primary' }}">2</a>
                                <p>Knowledge Base</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" wire:click="$set('currentStep', '3')" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-secondary' : 'btn-primary' }}">3</a>
                                <p>Persona & Instructions </p>
                            </div>

                            @if (Auth::user()->is_admin)
                                
                                <div class="stepwizard-step">
                                    <a href="#step-4" wire:click="$set('currentStep', '4')" type="button" class="btn btn-circle {{ $currentStep != 4 ? 'btn-secondary' : 'btn-primary' }}" disabled="disabled">4</a>
                                    <p>Integrations (Admins Only) </p>
                                </div>

                            @endif

                        </div>
                    </div>
                    <div class="px-4 p-2 row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h4 class="mb-3">Setup Your Twin:</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline mb-4 @error('model.title') is-invalid @enderror">

                                                <label for="title">Twin Title <small>(This is to identify your twins!):</small></label>
                                                <div class="input-group input-group-outline">
                                                <input type="text" id="title" wire:model.defer="model.title" class="form-control">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mt-5">
                                                <div class="form-check form-switch">
                                                    <input wire:model="model.is_active" class="form-check-input" type="checkbox" id="is_active" @if ($this->model->is_active == 1) checked="1" @endif>
                                                    <label class="form-check-label" for="is_active">Twin Power</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{--
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline mb-4 @error('model.kb_model_name') is-invalid @enderror ">
                                                <label for="kb_model_name" class="ms-0">Model:* @error('model.kb_model_name') {{$message}} @enderror</label>
                                                <div class="input-group input-group-outline">
                                                    <select class="form-control" id="kb_model_name" wire:model="model.kb_model_name">
                                                        <option value="" >Choose Twin</option>
                                                        <option value="gpt-3.5-turbo">Twin</option>
                                                        <option value="gpt-4-turbo-preview">Twin Pro</option>
                                                        <!-- <option value="Cohare">Twin Turbo</option> -->

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        --}}




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

                                        {{--
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline mb-4 @error('model.agent_dialect') is-invalid @enderror ">
                                                <label for="agent_dialect" class="ms-0">Twin Dialect:*</label>@error('model.agent_dialect') {{$message}} @enderror 
                                                <div class="input-group input-group-outline">
                                                    <select class="form-control" wire:model.defer="model.agent_dialect">
                                                        <option value="">Choose Twin Dialect</option>
                                                        <option value="English">English</option>
                                                        <option value="Egyptian Colloquial Arabic - اللهجة العامية المصرية">Egyptian Colloquial Arabic - اللهجة العامية المصرية
                                                        </option>
                                                        <option value="Modern Standard Arabic - العربية الفصحى">Modern Standard Arabic - العربية الفصحى</option>
                                                        <option value="Saudi Arabic - اللهجة السعودية">Saudi Arabic - اللهجة السعودية</option>
                                                        <option value="Levantine Arabic - اللهجة الشامية">Levantine Arabic - اللهجة الشامية</option>
                                                        <option value="Gulf Arabic - اللهجة الخليجية">Gulf Arabic - اللهجة الخليجية</option>
                                                        <option value="Moroccan Arabic - الدارجة المغربية">Moroccan Arabic - الدارجة المغربية</option>
                                                        <option value="Spanish - Español">Spanish - Español</option>
                                                        <option value="French - Français">French - Français</option>
                                                        <option value="Multilingual Adaptation - متعدد اللغات واللهجات">Multilingual Adaptation - متعدد اللغات واللهجات</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        --}}
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

                                    <hr>
                                    <div>
                                        <h4 class="mb-3">Twin Capabilities: </h4>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-3 card m-2 p-2">
                                            <div class="form-check">
                                                <input wire:model.defer="model.kb_model_name" class="form-check-input" type="radio" name="kb_model_name" id="twinLight" value="0.1" checked="checked">
                                                <label style="font-weight: 600;" class="custom-control-label" for="twinLight">Twin Light: 
                                                </label>
                                                <div style="width: auto !important;float: right;position: relative;top: 9px;" class="badge rounded-pill bg-primary w-30 mt-n2 mx-auto">10K Message/ 1000EGP</div>
                                            </div>
                                            <div>
                                                <p style="font-size: 13px;font-weight: 600;">Affordable, Formal Arabic, Basic Reasoning</p><p style="font-size: 11px;font-weight: 400;">Ideal for small businesses needing basic support in formal Arabic. Perfect for startups and local enterprises with straightforward tasks, ensuring cost-effective and simple AI assistance.</p>
                                            </div>

                                            <div class="col-md">
                                                <div class="input-group input-group-outline mb-4 @error('model.agent_dialect') is-invalid @enderror ">
                                                    <label for="agent_dialect" class="ms-0">Twin Dialect:*</label>@error('model.agent_dialect') {{$message}} @enderror 
                                                    <div class="input-group input-group-outline">
                                                        <select class="form-control" wire:model.defer="model.agent_dialect">
                                                            <option value="">Choose Twin Dialect</option>
                                                            <option value="English">English</option>
                                                            <option value="Modern Standard Arabic - العربية الفصحى">Modern Standard Arabic - العربية الفصحى</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 card m-2 p-2">
                                            <div class="form-check">
                                                <input wire:model.defer="model.kb_model_name" class="form-check-input" type="radio" name="kb_model_name" id="twin" value="0.6">
                                                <label style="font-weight: 600;" class="custom-control-label" for="twin">Twin:</label>
                                                <div style="width: auto !important;float: right;position: relative;top: 9px;" class="badge rounded-pill bg-primary w-30 mt-n2 mx-auto">10K Message/ 3500EGP</div>
                                            </div>
                                            <div>
                                                <p style="font-size: 13px;font-weight: 600;">Mid Price, Formal Arabic, Intermediate Logic</p><p style="font-size: 11px;font-weight: 400;">Suited for medium-sized businesses requiring formal Arabic and moderate reasoning. Great for agencies and growing businesses needing balanced insights and efficient AI support.</p>

                                            </div>


                                            <div class="col-md">
                                                <div class="input-group input-group-outline mb-4 @error('model.agent_dialect') is-invalid @enderror ">
                                                    <label for="agent_dialect" class="ms-0">Twin Dialect:*</label>@error('model.agent_dialect') {{$message}} @enderror 
                                                    <div class="input-group input-group-outline">
                                                        <select class="form-control" wire:model.defer="model.agent_dialect">
                                                            <option value="">Choose Twin Dialect</option>
                                                            <option value="English">English</option>
                                                            <option value="Egyptian Colloquial Arabic - اللهجة العامية المصرية">Egyptian Colloquial Arabic - اللهجة العامية المصرية
                                                            </option>
                                                            <option value="Modern Standard Arabic - العربية الفصحى">Modern Standard Arabic - العربية الفصحى</option>
                                                            <option value="Saudi Arabic - اللهجة السعودية">Saudi Arabic - اللهجة السعودية</option>
                                                            <option value="Levantine Arabic - اللهجة الشامية">Levantine Arabic - اللهجة الشامية</option>
                                                            <option value="Gulf Arabic - اللهجة الخليجية">Gulf Arabic - اللهجة الخليجية</option>
                                                            <option value="Moroccan Arabic - الدارجة المغربية">Moroccan Arabic - الدارجة المغربية</option>
                                                            <option value="Spanish - Español">Spanish - Español</option>
                                                            <option value="French - Français">French - Français</option>
                                                            <option value="Multilingual Adaptation - متعدد اللغات واللهجات">Multilingual Adaptation - متعدد اللغات واللهجات</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 card m-2 p-2">
                                            <div class="form-check">
                                                <input wire:model.defer="model.kb_model_name" class="form-check-input" type="radio" name="kb_model_name" id="twinTurbo" value="0.9">
                                                <label style="font-weight: 600;" class="custom-control-label" for="twinTurbo">Twin Turbo:</label>
                                                <div style="width: auto !important;float: right;position: relative;top: 9px;" class="badge rounded-pill bg-primary w-30 mt-n2 mx-auto">10K Message/ 9000EGP</div>
                                            </div>
                                            <div>
                                                <p style="font-size: 13px;font-weight: 600;">Best Value, Multi Dialects, Advanced Logic</p><p style="font-size: 11px;font-weight: 400;">Best for businesses seeking advanced support with multi-dialect capabilities. Ideal for large enterprises and diverse teams needing comprehensive AI assistance and creative problem-solving.</p>
                                            </div>


                                            <div class="col-md">
                                                <div class="input-group input-group-outline mb-4 @error('model.agent_dialect') is-invalid @enderror ">
                                                    <label for="agent_dialect" class="ms-0">Twin Dialect:*</label>@error('model.agent_dialect') {{$message}} @enderror 
                                                    <div class="input-group input-group-outline">
                                                        <select class="form-control" wire:model.defer="model.agent_dialect">
                                                            <option value="">Choose Twin Dialect</option>
                                                            <option value="English">English</option>
                                                            <option value="Egyptian Colloquial Arabic - اللهجة العامية المصرية">Egyptian Colloquial Arabic - اللهجة العامية المصرية
                                                            </option>
                                                            <option value="Modern Standard Arabic - العربية الفصحى">Modern Standard Arabic - العربية الفصحى</option>
                                                            <option value="Saudi Arabic - اللهجة السعودية">Saudi Arabic - اللهجة السعودية</option>
                                                            <option value="Levantine Arabic - اللهجة الشامية">Levantine Arabic - اللهجة الشامية</option>
                                                            <option value="Gulf Arabic - اللهجة الخليجية">Gulf Arabic - اللهجة الخليجية</option>
                                                            <option value="Moroccan Arabic - الدارجة المغربية">Moroccan Arabic - الدارجة المغربية</option>
                                                            <option value="Spanish - Español">Spanish - Español</option>
                                                            <option value="French - Français">French - Français</option>
                                                            <option value="Multilingual Adaptation - متعدد اللغات واللهجات">Multilingual Adaptation - متعدد اللغات واللهجات</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 card m-2 p-2">
                                            <div class="form-check">
                                                <input wire:model.defer="model.kb_model_name" class="form-check-input" type="radio" name="kb_model_name" id="twinPro" value="0.9">
                                                <label style="font-weight: 600;" class="custom-control-label" for="twinPro">Twin Pro:</label>
                                                <div style="width: auto !important;float: right;position: relative;top: 9px;" class="badge rounded-pill bg-primary w-30 mt-n2 mx-auto">10K Message/ 20000EGP</div>
                                            </div>
                                            <div>
                                                <p style="font-size: 13px;font-weight: 600;">Premium, Multi Dialects/Languages, Expert Logic</p><p style="font-size: 11px;font-weight: 400;">Perfect for multinational companies demanding top-tier AI support in multiple languages and dialects. Ensures the most sophisticated and logical outputs, suitable for complex and high-stakes tasks.</p>
                                            </div>


                                            <div class="col-md">
                                                <div class="input-group input-group-outline mb-4 @error('model.agent_dialect') is-invalid @enderror ">
                                                    <label for="agent_dialect" class="ms-0">Twin Dialect:*</label>@error('model.agent_dialect') {{$message}} @enderror 
                                                    <div class="input-group input-group-outline">
                                                        <select class="form-control" wire:model.defer="model.agent_dialect">
                                                            <option value="">Choose Twin Dialect</option>
                                                            <option value="English">English</option>
                                                            <option value="Egyptian Colloquial Arabic - اللهجة العامية المصرية">Egyptian Colloquial Arabic - اللهجة العامية المصرية
                                                            </option>
                                                            <option value="Modern Standard Arabic - العربية الفصحى">Modern Standard Arabic - العربية الفصحى</option>
                                                            <option value="Saudi Arabic - اللهجة السعودية">Saudi Arabic - اللهجة السعودية</option>
                                                            <option value="Levantine Arabic - اللهجة الشامية">Levantine Arabic - اللهجة الشامية</option>
                                                            <option value="Gulf Arabic - اللهجة الخليجية">Gulf Arabic - اللهجة الخليجية</option>
                                                            <option value="Moroccan Arabic - الدارجة المغربية">Moroccan Arabic - الدارجة المغربية</option>
                                                            <option value="Spanish - Español">Spanish - Español</option>
                                                            <option value="French - Français">French - Français</option>
                                                            <option value="Multilingual Adaptation - متعدد اللغات واللهجات">Multilingual Adaptation - متعدد اللغات واللهجات</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>


                                @if($addTwins)
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
                                    
                                    <hr>
                                    <div>
                                        <h4 class="mb-3">Your Knowledge Base Mode: </h4>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-4 card m-2 p-2">
                                            <div class="form-check">
                                                <input wire:model.defer="model.creativity_temperature" class="form-check-input" type="radio" name="creativity_temperature" id="creativityTemperature" value="0.1" checked="checked">
                                                <label style="font-weight: 600;" class="custom-control-label" for="creativityTemperature">My Knowledge Mode: 
                                                </label>
                                            </div>
                                            <div><p style="font-size: 13px;font-weight: 400;">Focuses solely on your personal files and data.</p><p style="font-size: 11px;font-weight: 400;">In this mode, the system utilizes only the information and content you provide, ensuring that outputs are based
                                            entirely on your own resources and knowledge.</p></div>
                                        </div>

                                        <div class="col-4 card m-2 p-2">
                                            <div class="form-check">
                                                <input wire:model.defer="model.creativity_temperature" class="form-check-input" type="radio" name="creativity_temperature" id="creativityTemperature" value="0.6">
                                                <label style="font-weight: 600;" class="custom-control-label" for="creativityTemperature">Hybrid Knowledge Mode:</label>
                                            </div>
                                            <div><p style="font-size: 13px;font-weight: 400;">Merges your personal files with AI-generated information.</p><p style="font-size: 11px;font-weight: 400;">This mode combines the uniqueness of your content with the extensive knowledge base of the AI, providing a balanced mix of personalized and AI-enhanced insights.</p></div>
                                        </div>

                                        <div class="col-4 card m-2 p-2">
                                            <div class="form-check">
                                                <input wire:model.defer="model.creativity_temperature" class="form-check-input" type="radio" name="creativity_temperature" id="creativityTemperature" value="0.9">
                                                <label style="font-weight: 600;" class="custom-control-label" for="creativityTemperature">AI-Primary Knowledge Mode:</label>
                                            </div>
                                            <div><p style="font-size: 13px;font-weight: 400;">Prioritizes AI knowledge, using it as the main source of information.</p><p style="font-size: 11px;font-weight: 400;">If you upload personal files, the AI creatively integrates them, enhancing the output. Without file uploads, the AI relies solely on its vast knowledge base, ensuring a wide range of information and creativity.</p></div>
                                        </div>
                                    </div>



    
                                    <div class="mb-3"></div>

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
                                                <label for="twin_a_persona">Twin Persona:</small></label>
                                                <textarea style="border: 1px solid #ababab; border-radius: 6px;" id="twin_a_persona" class="input-group input-group-outline" wire:model="model.agent_persona" rows="5" placeholder="Give your twin a persona!" spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 mb-3">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-outline">
                                                <label for="twin_what_to_do">Twin Instructions:</small></label>
                                                <textarea style="border: 1px solid #ababab; border-radius: 6px;" id="twin_what_to_do" class="input-group input-group-outline" wire:model="model.agent_instructions" rows="5" placeholder="Instruct your twin and tell what to do!" spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 mb-3">
                                        <div class="col-md-8">
                                            <div class="input-group input-group-outline">
                                                <label for="twin_live_offers">Special Notes (like live offers & discounts!):</small></label>
                                                <textarea style="border: 1px solid #ababab; border-radius: 6px;" id="twin_live_offers" class="input-group input-group-outline" wire:model="model.example_messages" rows="5" placeholder="Tell your twin any special notes like live offers & discounts!" spellcheck="false"></textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="$set('currentStep', '2')">Back</button>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Next</button>
                                </div>
                            </div>
                    </div>

                    @if (Auth::user()->is_admin)

                        <div class="px-4 p-2 row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">
                                <div class="col-xs-12">
                                        <h4 class="mb-3"> Integrations (Admins Only) :</h4>
                                        <div class="col-xs-12 mb-3">
                                            <div class="col-md-8">
                                                <div class="input-group input-group-outline">
                                                    <textarea class="form-control" wire:model="model.integrations_settings" rows="5" placeholder="Build intgration array!" spellcheck="false"></textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 mb-3">
                                            <div class="col-md-8">
                                                <div class="input-group input-group-outline">
                                                    <textarea class="form-control" wire:model="model.custom_settings" rows="5" placeholder="Add any custom settings here!" spellcheck="false"></textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 mb-3">
                                            <div class="col-md-8">
                                                <div class="input-group input-group-outline">
                                                    <textarea class="form-control" wire:model="model.handover_settings" rows="5" placeholder="Handle any handover settings here!" spellcheck="false"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 mb-3">
                                            <div class="col-md-8">
                                                <div class="input-group input-group-outline">
                                                    <label for="botbress_bot_id" >Botbress Bot Id</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="botbress_bot_id" id="botbress_bot_id" class="form-control" wire:model="model.botbress_bot_id" placeholder="Botbress Bot Id" spellcheck="false">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="input-group input-group-outline">
                                                    <label for="botbress_integration_key">Botbress Integration Key</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="botbress_integration_key" id="botbress_integration_key" class="form-control" wire:model="model.botbress_integration_key" placeholder="Botbress Integration Key" spellcheck="false">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="input-group input-group-outline">
                                                    <label for="botbress_workspace_id">Botbress Workspace Id</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="botbress_workspace_id" id="botbress_workspace_id" class="form-control" wire:model="model.botbress_workspace_id" placeholder="Botbress Workspace Id" spellcheck="false">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 mb-3">
                                            <div class="col-md-8">
                                                <div class="input-group input-group-outline">
                                                    <label for="user_id">User Id</label>
                                                    <div class="input-group input-group-outline">
                                                        <input type="text" name="user_id" id="user_id" class="form-control" wire:model="model.user_id" placeholder="User Id" spellcheck="false">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($addTwins)
                                            <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="insertTwins()" type="button" >Save</button>
                                        @else
                                            <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click.prevent="updateTwin()" type="button" >Save</button>
                                        @endif

                                </div>
                            </div> 
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



