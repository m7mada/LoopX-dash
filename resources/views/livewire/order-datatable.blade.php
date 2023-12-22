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
                        @foreach ($orders as $key => $item)
                            <tr  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration to get the loop index starting from 1 -->
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->pakedge->title }}</td>
                                <td>{{ $item->pakedge->price }}</td>
                                <td>
                                    @if ($item->payment =='pending')
                                    <button class="badge-danger btn" wire:click="updatePayment({{ $item->id }})">pending</button>
                                    @else
                                    <button class=" badge-success btn " wire:click="updatePayment({{ $item->id }})">completed</button>

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
