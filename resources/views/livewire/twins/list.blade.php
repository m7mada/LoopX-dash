<div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Aaref Twins</h6>
                        </div>
                    </div>
                    <div class=" me-3 my-3 text-end">
                        <a class="btn bg-gradient-dark mb-0" wire:click.prevent="addTwins();" href="javascript:;"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Twin</a>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            @if(count($model) > 0)

                                <table class="table-list table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Twin</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Knowledge files</th>
                                            @if (Auth::user()->is_admin)
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    User </th>
                                            @endif
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Status</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                Usage</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($model as $twin)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2" data-id="{{ $twin->twin_external_id }}">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/favicon.png"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="spotify">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">{{ $twin->title }} </h6>
                                                            @if(\Auth::user()->is_admin) <span class="me-2 text-xs"> {{$twin->twin_external_id}} </span> @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                <p class="text-sm font-weight-bold mb-0">{{count($twin->files)}}</p>
                                                </td>
                                                @if (Auth::user()->is_admin)
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">{{$twin->user->email}}</p>
                                                </td>
                                                @endif

                                                <td>
                                                    @if ($twin->is_active == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-warning">Stoped</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">

                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">{{count($twin->messages->where('role', '=', 'assistant'))}} Reply </span>
                                                        <!-- <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="{{count($twin->messages)}}"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: {{ count($twin->messages) / 100 }}%;"></div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="/show-logs/{{$twin->id}}/"><i class="fa fa-comments fixed-plugin-button-nav cursor-pointer"></i></a> | 
                                                    <i wire:click.prevent="editTwins({{$twin->id}});" class="fa fa-cog fixed-plugin-button-nav cursor-pointer" aria-hidden="true"></i>

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