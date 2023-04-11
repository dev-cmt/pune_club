<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Event Registation List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table header-border table-hover verticle-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Payment Number</th>
                                    {{-- <th scope="col">Transaction No.</th> --}}
                                    <th scope="col">Person No.</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Event Details</th>
                                    <th scope="col">Registation Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=> $row)
                                <tr>
                                    <td>
                                        @if ($row->payment_type == '0')Cash
                                        @elseif ($row->payment_type == '1')bKash
                                        @elseif ($row->payment_type == '2')Nagad
                                        @elseif ($row->payment_type == '3')Roket
                                        @endif
                                    </td>
                                    <td>{{$row->payment_number}}</td>
                                    {{-- <td>{{$row->transaction_no}}</td> --}}
                                    <td>{{$row->person_no}}</td>
                                    <td>{{$row->total_amount}}</td>
                                    <td>
                                        @if ($row->status == '0')<span class="badge light badge-warning">Pending</span>
                                        @elseif ($row->status == '1')<span class="badge light badge-success">Complete</span>
                                        @elseif ($row->status =='2')<span class="badge light badge-danger">Canceled</span>  
                                        @endif
                                    </td>
                                    <td><a class="badge badge-success" href="{{route('page.events_details', $row->event_id)}}">View</a></td>
                                    <td>{{date('F d, Y h:i A', strtotime($row->created_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
