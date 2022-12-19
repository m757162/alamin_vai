@extends('backend.master')
@section('title', 'Orders | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Orders</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            
                            <tbody>
                                <tr>
                                    <th width="20%">Freelancer</th>
                                    <td>{{ $order->hire->freelancer->name }}</td>
                                </tr>

                                <tr>
                                    <th>Client</th>
                                    <td>{{ $order->hire->client->name }}</td>
                                </tr>

                                <tr>
                                    <th>Commission</th>
                                    <td>{{ currency_symbol() .''. $order->commission_amount }}</td>
                                </tr>

                                <tr>
                                    <th>Freelancer Amount</th>
                                    <td>{{ currency_symbol() .''. $order->freelancer_amount  }}</td>
                                </tr>

                                <tr>
                                    <th>Total Amount</th>
                                    <td>{{ currency_symbol() .''. $order->total_amount }}</td>
                                </tr>

                                <tr>
                                    <th>Payment Status</th>
                                    <td>
                                        @if($order->payment_status == 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @elseif($order->payment_status == 'unpaid')
                                            <span class="badge badge-warning">Unpaid</span>
                                        @else 
                                            <span class="badge badge-failed">Failed</span>
                                        @endif 
                                    </td>
                                </tr>

                                <tr>
                                    <th>Payment Method</th>
                                    <td>{{ $order->payment_method }}</td>
                                </tr>

                                <tr>
                                    @php 
                                        $payment_info_decode = json_decode($order->payment_info, true);

                                    @endphp
                                    <th>Payment Info</th>
                                    <td>
                                        @foreach($payment_info_decode as $key => $payment_info)
                                            @if($loop->last)
                                                {{ ucfirst($key) .'-'. $payment_info }}
                                                @break
                                            @endif 

                                            {{ ucfirst($key) .'-'. $payment_info . ',' }}
                                        @endforeach
                                        
                                    </td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($order->delivery_status == 'pending')
                                            <span class="badge badge-secondary">Pending</span>
                                        @elseif($order->delivery_status == 'inprogress')
                                            <span class="badge badge-primary">Inprogress</span>
                                        @elseif($order->delivery_status == 'completed')
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($order->delivery_status == 'cancel')
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Is Accept</th>
                                    <td>
                                        @if($order->is_accept == 1)
                                            <span class="badge badge-success">Accepted</span>
                                        @elseif($order->is_accept == 0)
                                            <span class="badge badge-danger">Not Accept</span>
                                        @endif 
                                    </td>
                                </tr>

                                <tr>
                                    <th>Is Delivered</th>
                                    <td>
                                        @if($order->is_delivered == 'delivered')
                                            <span class="text-warning">Waiting for accept by client</span>
                                        @elseif($order->is_delivered == 'accept_delivery')
                                            <span class="badge badge-success">Delivered</span>
                                        @elseif($order->is_delivered == 'not_accept_delivery')
                                            <span class="text-danger">Declined By Client</span>
                                        @else 
                                            ---
                                        @endif 
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">
                                        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        
                    </div>

                    
                </div><!--End card body-->
            </div><!--End card-->
        </div><!--End Col-->

    </div><!--End row-->

    <!-- Content Row -->

    
@endsection

@section ('footer_scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
@endsection