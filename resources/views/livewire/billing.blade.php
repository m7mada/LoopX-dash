
    <div class="">
        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                @forelse($pakedge as $key => $item)
                                <div class="col-md-3 col-4">
                                    <div class="card">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div
                                                class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                {{-- <i class="material-icons opacity-10">account_balance</i> --}}
                                                <i class="fas {{$item->class_name}}"></i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            <h6 class="text-center mb-0">{{$item->title}}</h6>
                                            <span class="text-xs">{{$item->description}}
                                            </span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">+${{$item->price}}</h5>
                                            <button type="button" class="btn btn-info mb-0 btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">Add Order</button>
                                        </div>
                                        @include('livewire._model_order')
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100">

                        <div class="card-body p-3 pb-0">
                            <ul class="list-group">
                                @foreach ($orders as $item )
                                <li
                                class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</h6>
                                    <span class="text-xs">{{$item->serial_number}}</span>
                                </div>

                                <div class="d-flex align-items-center text-sm">
                                    {{$item->pakedge->title}}
                                    @if($item->payment == 'pending')
                                    <span class="btn btn-link text-danger text-sm mb-0 px-0 ms-4">
                                        {{$item->payment}}
                                    </span>
                                    @else
                                    <span class="btn btn-link text-success text-sm mb-0 px-0 ms-4">
                                        {{$item->payment}}
                                    </span>
                                    @endif

                                </div>
                            </li>

                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


