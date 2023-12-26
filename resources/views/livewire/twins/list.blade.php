<div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Jamaika Twins</h6>
                        </div>
                    </div>
                    <div class=" me-3 my-3 text-end">
                        <a class="btn bg-gradient-dark mb-0" wire:click.prevent="addTwins();" href="javascript:;"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Twin</a>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            @if( count($model) > 0 )

                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Twin</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Knolage Files</th>
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
                                        @foreach($model as $twin )
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/small-logos/logo-asana.svg"
                                                            class="avatar avatar-sm rounded-circle me-2"
                                                            alt="spotify">
                                                    </div>
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm">{{ $twin->title }} {{$this->showLogs}}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <p class="text-sm font-weight-bold mb-0">{{count($twin->files)}}</p>
                                            </td>
                                            <td>
                                                @if ( $twin->is_active == 1 )
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-warning">Stoped</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">

                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span class="me-2 text-xs font-weight-bold">{{count($twin->messages)}} Messages </span>
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
                                                <button class="btn btn-link text-secondary mb-0 " type="button" data-bs-toggle="dropdown">
                                                    <span class="material-icons">more_vert</span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a wire:click.prevent="editTwins({{$twin->id}});" class="dropdown-item" href="#">Setting</a></li>
                                                    <li><a wire:click.prevent="showTwinConverssations({{$twin->id}});" class="dropdown-item" href="#">Logs</a></li>
                                                </ul>
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