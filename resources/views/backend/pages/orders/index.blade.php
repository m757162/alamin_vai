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
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Freelancer</th>
                                    <th width="10%">Client</th>
                                    <th width="5%">Commission</th>
                                    <th width="10%">Freelancer Amount</th>
                                    <th width="10%">Amount</th>
                                    <th width="10%">Payment Status</th>
                                    <th width="10%">Payment Method</th>
                                    <th width="10%">Delivery Status</th>
                                    <th width="5%">Action</th>                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Freelancer</th>
                                    <th width="10%">Client</th>
                                    <th width="5%">Commission</th>
                                    <th width="10%">Freelancer Amount</th>
                                    <th width="10%">Amount</th>
                                    <th width="10%">Payment Status</th>
                                    <th width="10%">Payment Method</th>
                                    <th width="10%">Delivery Status</th>
                                    <th width="5%">Action</th>    
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse($orders as $key => $order)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $order->hire->freelancer->name }}</td>
                                    <td>{{ $order->hire->client->name }}</td>
                                    <td class="text-center">{{ currency_symbol() .''. $order->commission_amount }}</td>
                                    <td class="text-center">{{ currency_symbol() .''. $order->freelancer_amount  }}</td>
                                    <td class="text-center">{{ currency_symbol() .''. $order->total_amount }}</td>
                                    <td class="text-center">
                                        @if($order->payment_status == 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @elseif($order->payment_status == 'unpaid')
                                            <span class="badge badge-warning">Unpaid</span>
                                        @else 
                                            <span class="badge badge-failed">Failed</span>
                                        @endif 
                                    </td>
                                    <td class="text-center">{{ $order->payment_method }}</td>
                                    <td class="text-center">
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
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', encrypt($order->id)) }}" class="btn btn-primary btn-circle"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @empty 
                                    <tr>
                                        <td colspan="10" class="text-center">No data found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>

                    <div>
                            {{ $orders->links() }}
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