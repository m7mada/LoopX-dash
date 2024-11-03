<div>

{{-- wire:poll=" getMessges( '{{ $this->model->twin_external_id }}' , '{{ request()->conversationId }}' ) " --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4" style="min-height: calc(100vh - 140px);">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ $model->title }} Conversations
                            </h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive p-0">
                            @if (count($model->messages) > 0)
                                <div class="card card-frame">
                                    <div class="card-body p-0">
                                        <main class="content">
                                            <div >
                                                <div class="card">
                                                    <div class="row g-0" style="position: relative;">
                                                        

                                                    <div class="col-12 col-lg-5 col-xl-3 border-right" id="logs-filter" style="padding: 10px 5px 0 5px;transition: 0.4s;position: absolute;left: -25%;border: 1px solid #ddd;z-index: 1;top: 74px;bottom: 0;border-top: 0px solid #ddd;">
                                                        <div style="padding: 0 15px;border-top: 1px solid #ddd;background-color: #fff;height: 100%;">


                                                            <form class="mt-2" name="messages_filer" method="get">

                                                                <!-- <label class="form-label mb-0">Text</label>
                                                                <div class="input-group input-group-outline mb-2">
                                                                    <input type="text" class="form-control form-control-sm">
                                                                </div> -->


                                                                <label class="form-label mb-0">Date From</label>
                                                                <div class="input-group input-group-outline mb-2">
                                                                    <input name="search_date_from" type="date" class="form-control form-control-sm">
                                                                </div>
                                                                
                                                                <label class="form-label mb-0">Date To</label>
                                                                <div class="input-group input-group-outline mb-2">
                                                                    <input name="search_date_to" type="date" class="form-control form-control-sm">
                                                                </div>

                                                                <!-- <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
                                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Checked switch</label>
                                                                </div> -->


                                                                <label for="select1" class="form-label mb-0">Chanel</label>
                                                                <div class="input-group input-group-outline mb-2">
                                                                    <select class="form-control form-control-sm" id="search_chanel" name="search_chanel">
                                                                        <option value="messenger">Messenger</option>
                                                                        <option value="Whatsapp">WhatsApp</option>
                                                                        <option value="telegram">Telegram</option>
                                                                        <option value="webchat">Website</option>
                                                                        <option value="" selected>All</option>
                                                                    </select>
                                                                </div>

                                                                <!-- <label for="select1" class="form-label mb-0">Conversation Status</label>
                                                                <div class="input-group input-group-outline mb-2">
                                                                    <select class="form-control form-control-sm" id="search_conversation_status" name="search_conversation_status">
                                                                        <option value="active">Active</option>
                                                                        <option value="paused">Paused</option>
                                                                        <option value="" selected>All</option>
                                                                    </select>
                                                                </div> -->

                                                                <div class="mb-3 text-center">
                                                                    <button id="done-logs-filter" class="btn btn-icon btn-3 btn-primary" type="submit">
                                                                        <span class="btn-inner--text">Filter</span>
                                                                    </button>
                                                                </div>

                                                                <input type="hidden" name="search_conversation_id" id="search_conversation_id" >
                                                                
                                                            </form>

                                                        </div>
                                                    </div>
                                                  

                                                        <div class="col-12 col-lg-5 col-xl-3 border-right" style="overflow-y: scroll;overflow-x: hidden;max-height: calc(100vh - 316px);border-right: 1px solid #ddd;border-top: 1px solid #ddd;margin-top: 16px; @if( isset( request()->conversationId )) display:none @endif">




                                                            <div class="px-2 d-none d-md-block">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1 d-flex align-items-center">
                                                                        <input type="text" class="form-control my-3 mb-0" id="searchConversationInput" placeholder="Search For Conversation..." style="border: 1px solid #ddd;padding: 9px 12px;">
                                                                        <button id="show-hide-logs-filter" style="margin-right: 0px !important;margin-left: 5px !important;box-shadow: none;padding: 6px 0px 4px 0px;border-radius: 4px;height: 42px;width: 40px;" type="button" class="my-3 mb-0 btn btn-primary btn-sm m-1"><i style="font-size: 0.7rem;" class="fa fa-filter"></i></button>
                                                                    </div>

                                                                
                                                                </div>
                                                                
                                                            </div>


                                                            @forelse ($model->messages->groupBy('botpress_conversation_id')->sortByDesc(function ($item) {
                                                                        return \Carbon\Carbon::parse($item->last()->created_at->format('M j, y g:iA'));
                                                                    }) as $conversationId => $messages)

                                                                    
                                                                <a class="list-group-item list-group-item-action border-0" style="border-bottom: 1px solid #ddd !important ; @if( ! empty( $this->mt_twins ) && isset( $this->mt_twins->last()->botpress_conversation_id ) && $this->mt_twins->last()->botpress_conversation_id == $messages->first()->botpress_conversation_id ) background-color: rgb(227, 227, 227); @endif" wire:click.prevent="getMessges('{{ $messages->first()->twin_id }}', '{{ $messages->first()->botpress_conversation_id }}')" >
                                                                    <div class="chat-item d-flex align-items-start">
                                                                        
                                                                        <!-- <img style="border: 1px solid #adadad !important;" src="https://images.assetsdelivery.com/compings_v2/tanyadanuta/tanyadanuta1910/tanyadanuta191000003.jpg" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40"> -->
                                                                        <div class="flex-grow-1" style="margin-left: 10px;">
                                                                            @if($messages->isNotEmpty())
                                                                                <!-- <div class="small">{{ $messages->first()->created_at->format('Y-m-d H:i:s') }}</div>
                                                                                <div class="small">
                                                                                    <span class="fas fa-circle @if ( empty($messages->first()->isPauseConversation) )chat-online @else text-danger @endif"></span>
                                                                                    {{ $messages->first()->botpress_integration }}
                                                                                </div> -->

                                                                                <div class="small" style="text-transform: capitalize;">{{ $messages->first()->botpress_integration }} User </div>
                                                                                <div class="small" style="font-size: 10px;">
                                                                                    <span class="fas fa-circle @if ( empty($messages->first()->isPauseConversation) )chat-online @else text-danger @endif"></span>
                                                                                    
                                                                                    <span onclick="copyText(event, '{{$conversationId}}')" 
                                                                                    style="padding: 4px 8px;background-color: #f3f3f3;border-radius: 6px;cursor: copy;"
                                                                                    id="botpress_conversation_id_{{$conversationId ?? '0'}}">
                                                                                    {{$conversationId ?? "0"}}
                                                                                        <i class="fa fa-clone" aria-hidden="true"></i>
                                                                                    </span>


                                                                                    <div class="small" style="font-size: 11px;display: flex;flex-direction: column;justify-content: center;align-items: self-start;margin-top: 5px;">
                                                                                        <span>{{ $messages->last()->created_at->format('M j, y g:iA') }}</span>
                                                                                    </div>

                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                        <div class="d-flex flex-column align-items-center">
                                                                            <div class="badge bg-success float-right" style="background: #9094e9 !important;padding: 4px 10px;font-size: 10px;min-width: 25px;height: 25px;border-radius: 20px;line-height: 18px;margin-top: 18px;">{{count($messages)}}</div>
                                                                        </div>
                                                                        

                                                                    </div>
                                                                </a>

                                                                @empty
                                                            @endforelse

                                                            <hr class="d-block d-lg-none mt-1 mb-0">
                                                        </div>
                                                        <div class="col-12 @if( ! isset( request()->conversationId )) col-lg-7 col-xl-9 @endif" >
                                                            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                                                <div class="d-flex justify-content-between">
                                                                    @if($mt_twins)
                                                                        {{-- <div class="badge bg-success float-right m-1">{{$this->mt_twins->first()->botpress_integration}} User </div> -->
                                                                        <!-- <h7>
                                                                            Conversation Created on {{ $this->mt_twins->first()->created_at->format('Y-m-d H:i:s') ?? '' }} by {{
                                                                            $this->mt_twins->first()->botpress_integration }}
                                                                        </h7> --}}

                                                                        <h6 class="m-0 p-0" style="text-transform: capitalize;">
                                                                            {{$this->mt_twins->first()->botpress_integration ?? '' }} User
                                                                        </h6>


                                                                        <div class="d-flex flex-row align-items-center">
                                                                            <button wire:click="playPauseConversation('{{ $this->mt_twins->first()->botpress_conversation_id }}')"
                                                                                type="button" style="
                                                                                    border: 0;
                                                                                    background-color: transparent;
                                                                                    margin-right: 10px;
                                                                                    font-size: 19px;
                                                                                    width: 30px;
                                                                                    height: 30px;
                                                                                    padding: 0;
                                                                                    display: flex;
                                                                                    align-items: center;
                                                                                    justify-content: center;
                                                                                ">
                                                                                @if ( empty($this->mt_twins->first()->isPauseConversation) )
                                                                                <span class="btn-inner--icon"><i class="fa fa-pause-circle-o"></i></span>
                                                                                @else
                                                                                <span class="btn-inner--icon"><i class="fa fa-play-circle-o"></i></span>
                                                                                @endif
                                                                            </button>
                                                                            @if( ! request()->conversationId )
                                                                                <a target="_blank" href="{{ $this->mt_twins->first()->botpress_conversation_id }}"> <span class="btn-inner--icon"><i class="fa fa-external-link"></i></span></a>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                    
                                                                    
                                                                    {{--<div>
                                                                        <button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg">
                                                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                                                </path>
                                                                            </svg></button>
                                                                        <button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg">
                                                                                <polygon points="23 7 16 12 23 17 23 7">
                                                                                </polygon>
                                                                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                                                            </svg></button>
                                                                        <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg">
                                                                                <circle cx="12" cy="12" r="1"></circle>
                                                                                <circle cx="19" cy="12" r="1"></circle>
                                                                                <circle cx="5" cy="12" r="1"></circle>
                                                                            </svg></button>
                                                                    </div>
                                                                    --}}
                                                                </div>
                                                            </div>

                                                            <div class="position-relative chat-messages-box">
                                                                <div class="chat-messages p-4" id="chat-messages" style="height: calc(100vh - 326px);">
                                                                    @if($messages)
                                                                    @forelse ($mt_twins as $item )

                                                                    @if ( $item->role == "user")
                                                                        <div class="chat-message chat-message-right pb-4">
                                                                            <div>
                                                                                {{-- <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40"> --}}
                                                                                <div class="text-muted small text-nowrap mt-2">
                                                                                    </div>
                                                                            </div>
                                                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                                {{$item->content}}
                                                                                <span class="chat-message-data">{{ $item->created_at->format('M j, y g:iA') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    @else
                                                                    <div class="chat-message chat-message-left pb-4">
                                                                        <div>
                                                                            {{-- <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40"> --}}
                                                                            <div class="text-muted small text-nowrap mt-2">
                                                                                </div>
                                                                        </div>
                                                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                            {{$item->content}}
                                                                            <span class="chat-message-data">{{ $item->created_at->format('M j, y g:iA') }}</span>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @empty
                                                                    <span></span>
                                                                    @endforelse
                                                                    @endif 


                                                                </div>
                                                            </div>
                                                            @if($mt_twins)
                                                            <div class="flex-grow-0 py-3 px-4 border-top">
                                                                <div class="input-group" style="border: 1px solid #ddd;border-radius: 9px;padding: 0 0 0 22px;">
                                                                    <input  type="text" autocomplete="off"  id="inbutMessageToSendToUser" class="form-control" placeholder="Type your message" wire:model.defer="inbutMessageToSendToUser" wire:keydown.enter="sendMessageToUser()" wire:loading.attr="disabled" >
                                                                    <button style="height: 50px;margin: 0;" class="btn btn-primary" wire:click.prevent="sendMessageToUser()" wire:loading.sendMessageToUser.attr="disabled">Send</button>
                                                                </div>
                                                            </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


