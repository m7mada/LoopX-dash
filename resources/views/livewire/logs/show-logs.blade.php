<div>
<div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{$this->model->title}} Conversassions Log </h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            @if( count($model->messages) > 0 )

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
                                        @foreach($model->messages as $log )
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
                                                <button wire:click.prevent="showConverssationMessages({{$log->botpress_conversation_id}})" class="btn btn-link text-secondary mb-0 " type="button">
                                                    <span class="material-icons">more_vert</span>
                                                </button>
                                                
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
