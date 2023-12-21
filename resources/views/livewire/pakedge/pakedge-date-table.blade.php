<div>
    <div class="container">
        <div class="card mt-5">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">create</button> --}}
                    <a href="{{route('addPakedge')}}" class="btn btn-info">create</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                price</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Discount</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Discrption</th>

                            <th class="text-secondary opacity-7">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pakedges as $key => $item)
                            <tr  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration to get the loop index starting from 1 -->
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->discount }}</td>
                                <td>{{ $item->description }}</td> <!-- Corrected 'discrption' to 'description' -->
                                <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('editPakedge',$item->id)}}" class="btn btn-warning btn-sm m-1">Edit</a>
                                    <a href="{{route('showPakedge',$item->id)}}" class="btn btn-secondary btn-sm m-1">Show</a>
                                    <button type="button"  wire:click="confirmDelete({{ $item->id }})"class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                                </div>
                                </td>
                            </tr>
                            @include('livewire.pakedge._modleDelete')
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div><!-- Button trigger modal -->


    </div>

</div>

