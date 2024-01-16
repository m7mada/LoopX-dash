<div>
    <div class="container">
        <div class="card mt-5">
            <div class="row">
                @include('livewire.pakedge.message')

            </div>
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Email</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Phone</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Pakedge Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Price</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Paayment Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr  class="text-center text-secondary text-xs ">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>  
                                    <span class="badge badge-pill badge-lg bg-gradient-success">{{$item->order_lines->first()->packages_price->package->title}}</span>
                                    @foreach ($item->order_lines as $line )

                                        <button type="button" class="btn btn-primary">
                                            <span>{{ $line->benefit->name }} </span>
                                            <span class="badge badge-sm badge-circle badge-danger border border-white border-2">{{ $line->value }}</span>
                                        </button>
                                    
                                    @endforeach
                                </td>
                                <td>{{ $item->net_paid }}</td>
                                <td>
                                    @if ($item->is_paid == 0 )
                                    <button class="badge-danger btn" wire:click="updatePayment({{ $item->id }} , 1 )">pending</button>
                                    @else
                                    <button class=" badge-success btn ">Paid</button>

                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div><!-- Button trigger modal -->


    </div>

</div>

@section('script')

@endsection
