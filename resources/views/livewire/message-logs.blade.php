<div>
<div class="container-fluid pb-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{$this->twin->title}} Conversassions Log </h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            @if( count($model) > 0 )

                                <table class="table align-items-center justify-content-center mb-0">
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
                                        @foreach($model as $log )
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$log->botpress_conversation_id}}</p>
                                            </td>
                                            <td>
                                                <span class="text-secondary text-xs font-weight-normal">{{$log->botpress_createdOn}}</span>

                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-sm badge-success">{{$log->botpress_channel}}</span>
                                            </td>
                                            <td class="align-middle">
                                                
                                            <!-- <a wire:click.prevent="converssationMessages({{$log->botpress_conversation_id}})"  >
                                                        <span class="material-icons">more_vert</span>
                                                         edit 
                                                    </a>
                                            <button wire:click.prevent="converssationMessages()" class="btn btn-info">Edit</button> -->




                                            <div class="col-md-4">
                                                <button type="button" class="btn bg-gradient-success btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modal-default">Messages</button>
                                                <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title font-weight-normal" id="modal-title-default">Conversation</h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-lg-6">
                                                            <div class="card">
                                                                <!-- <div class="card-header pb-0">
                                                                    <h6>Timeline light</h6>
                                                                </div> -->
                                                                <div class="card-body p-3">
                                                                    <div class="timeline timeline-one-side" data-timeline-axis-style="dotted">

                                                                        
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-dark p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">notifications</i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                    People care about how you see the world, how you think, what motivates you,
                                                                                    what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-primary p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">code</i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">21 DEC 11 PM</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-success p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">
                                                                                shopping_cart
                                                                                </i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April
                                                                                </h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-info p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">
                                                                                credit_card
                                                                                </i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order
                                                                                #4395133</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-dark p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">
                                                                                vpn_key
                                                                                </i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for
                                                                                development</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-primary p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">
                                                                                inventory_2
                                                                                </i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">New message unread</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">16 DEC</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-success p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">
                                                                                done
                                                                                </i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Notifications unread</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">15 DEC</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block mb-3">
                                                                            <span class="timeline-step bg-info p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">
                                                                                mail
                                                                                </i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">New request</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">14 DEC</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="timeline-block">
                                                                            <span class="timeline-step bg-dark p-3">
                                                                                <i class="material-icons text-white text-sm opacity-10">
                                                                                sports_esports
                                                                                </i>
                                                                            </span>
                                                                            <div class="timeline-content pt-1">
                                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">Controller issues</h6>
                                                                                <p class="text-secondary text-xs mt-1 mb-0">13 DEC</p>
                                                                                <p class="text-sm text-dark mt-3 mb-2">
                                                                                People care about how you see the world, how you think, what motivates you,
                                                                                what you’re struggling with or afraid of.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>


                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
