@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Transactions</h1>
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
                                    <th width="20%">Freelancer</th>
                                    <th width="20%">Client</th>
                                    <th width="15%">Type</th>
                                    <th width="15%">Amount</th>
                                    <th width="15%">Date</th>
                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Freelancer</th>
                                    <th>Client</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse($transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if($transaction->freelancer != NULL)
                                            {{ $transaction->freelancer->name }}
                                        @else 
                                            -
                                        @endif 
                                        
                                    </td>
                                    <td>
                                        @if($transaction->client != NULL)
                                            {{ $transaction->client->name }}
                                        @else 
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($transaction->type == 'debit')
                                            <span class="badge badge-success">Debit</span>
                                        @elseif($transaction->type == 'credit')
                                            <span class="badge badge-danger">Credit</span>
                                        @endif 
                                    </td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ date('M d'.','. ' Y', strtotime($transaction->created_at)) }}</td>
                                </tr>
                                @empty 
                                    <tr>
                                        <td colspan="6" class="text-center">No data found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>

                    <div>
                            {{ $transactions->links() }}
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