<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ $this->model->title }} Conversassions Log
                            </h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            @php
                            use Carbon\Carbon;
                            @endphp
                            @if (count($model->messages) > 0)

                            <div class="card card-frame">
                                <div class="card-body">
                                    <main class="content">
                                        <div class="container p-0">
                                            <div class="card">
                                                <div class="row g-0">
                                                    <div class="col-12 col-lg-5 col-xl-3 border-right" style="border-right: 1px solid #ddd;border-top: 1px solid #ddd;margin-top: 24px;">
                                                        @forelse ($model->messages->groupBy('botpress_conversation_id') as $conversationId => $messages)
                                                        @php
                                                            $botpress_conversation_id = $messages->first()->botpress_conversation_id;
                                                            $twin_id = $messages->first()->twin_id;
                                                        @endphp

                                                        <a class="list-group-item list-group-item-action border-0" style="border-bottom: 1px solid #ddd !important" wire:click.prevent="getMessges('{{ $twin_id }}', '{{ $botpress_conversation_id }}')">
                                                            <div class="d-flex align-items-start">
                                                                
                                                            <img style="border: 1px solid #adadad !important;" src="https://images.assetsdelivery.com/compings_v2/tanyadanuta/tanyadanuta1910/tanyadanuta191000003.jpg" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
                                                                <div class="flex-grow-1" style="margin-left: 10px;">
                                                                    @if($messages->isNotEmpty())
                                                                        <div class="small">{{ $messages->first()->created_at->format('Y-m-d H:i:s') }}</div>
                                                                        <div class="small">
                                                                            <span class="fas fa-circle chat-online"></span>
                                                                            {{ $messages->first()->botpress_integration }}
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="badge bg-success float-right">{{count($messages)}}</div>
                                                            </div>
                                                        </a>

                                                    @empty
                                                    @endforelse

                                                        <hr class="d-block d-lg-none mt-1 mb-0">
                                                    </div>
                                                    <div class="col-12 col-lg-7 col-xl-9">
                                                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                                            <div class="d-flex align-items-center py-1">


                                                                {{-- <div>
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
                                                                </div> --}}
                                                            </div>
                                                        </div>

                                                        <div class="position-relative">
                                                            <div class="chat-messages p-4">
                                                                {{-- @dump($llMessage) --}}
                                                                @if($messages)
                                                                @forelse ($mt_twins as $item )
                                                                {{-- @dump($item->toArray()) --}}


                                                                @if ( $item->role == "user")
                                                                    <div class="chat-message-right pb-4">
                                                                        <div>
                                                                            {{-- <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40"> --}}
                                                                            <div class="text-muted small text-nowrap mt-2">
                                                                                </div>
                                                                        </div>
                                                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                                            <div class="font-weight-bold mb-1">User
                                                                                <div class="text-muted small text-nowrap" style="font-size: 12px;color: #939393 !important;">
                                                                                    {{ $item->created_at->format('Y-m-d H:i:s') }}
                                                                                </div>
                                                                            </div>
                                                                            {{$item->content}}
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                <div class="chat-message-left pb-4">
                                                                    <div>
                                                                        {{-- <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40"> --}}
                                                                        <div class="text-muted small text-nowrap mt-2">
                                                                            </div>
                                                                    </div>
                                                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                                        <div class="font-weight-bold mb-1">{{$model->title}}
                                                                            <div class="text-muted small text-nowrap" style="font-size: 12px;color: #939393 !important;">
                                                                                {{ $item->created_at->format('Y-m-d H:i:s') }}
                                                                            </div>
                                                                            </div>
                                                                        {{$item->content}}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @empty
                                                                <span></span>
                                                                @endforelse
                                                                @endif 


                                                            </div>
                                                        </div>

                                                        {{-- <div class="flex-grow-0 py-3 px-4 border-top">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Type your message">
                                                                <button class="btn btn-primary">Send</button>
                                                            </div>
                                                        </div> --}}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                            {{-- <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            ID</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Date</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Chanel</th>
                                        <th></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model->messages->groupBy('botpress_conversation_id') as $conversationId => $messages)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $conversationId }}</p>
                            </td>
                            <td>
                                <!-- Display additional information about the conversation if needed -->
                            </td>
                            <td class="align-middle text-center">
                                <!-- Display additional information about the conversation if needed -->
                            </td>
                            <td class="align-middle">
                                <button wire:click.prevent="showConverssationMessages({{ $conversationId }})" class="btn btn-link text-secondary mb-0 " type="button">
                                    <span class="material-icons">more_vert</span>
                                </button>
                            </td>
                            </tr>
                            @foreach ($messages as $log)
                            <tr>
                                <td>
                                    <!-- Display individual message details if needed -->
                                </td>
                                <td>
                                    <!-- Display individual message details if needed -->
                                </td>
                                <td class="align-middle text-center">
                                    <!-- Display individual message details if needed -->
                                </td>
                                <td class="align-middle">
                                    <!-- Display individual message details if needed -->
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            </tbody>

                            </table> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('body')
    <script>
        // .list-group-item:first-child
        console.log("test");
    </script>
@endpush

