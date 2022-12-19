@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Withdraw Requests</h1>
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
                                    <th width="20%">Payment Method</th>
                                    <th width="15%">Amount</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Date</th>
                                    <th width="10%">Action</th>
                                    
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse($withdraw_requests as $key => $withdraw_request)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {{ $withdraw_request->freelancer->name }}
                                    </td>
                                    <td>
                                        {{ $withdraw_request->payment_method }}
                                    </td>
                                    <td>{{ currency_symbol().' '.$withdraw_request->amount }}</td>
                                    <td>
                                        @if($withdraw_request->status == 'pending')
                                            <span class="badge badge-secondary">Pending</span>                                                
                                        @elseif($withdraw_request->status == 'inprogress')
                                            <span class="badge badge-primary">Inprogress</span>
                                        @elseif($withdraw_request->status == 'completed')
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($withdraw_request->status == 'reject')
                                            <span class="badge badge-danger">Reject</span>
                                        @endif
                                    </td>
                                    
                                    <td>{{ date('M d'.','. ' Y', strtotime($withdraw_request->created_at)) }}</td>
                                    <td class="text-center">
                                        
                                        <div class="dropdown no-arrow mb-1">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="withdrawDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="withdrawDropdown" style="">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a href="{{ route('admin.withdraw.status.update', ['id' => encrypt($withdraw_request->id), 'status' => 'pending']) }}" class="dropdown-item ">Pending</a>
                                                <a href="{{ route('admin.withdraw.status.update', ['id' => encrypt($withdraw_request->id), 'status' => 'inprogress']) }}" class="dropdown-item ">Inprogress</a>
                                                <a href="{{ route('admin.withdraw.status.update', ['id' => encrypt($withdraw_request->id), 'status' => 'completed']) }}" class="dropdown-item ">Completed</a>
                                                <a href="{{ route('admin.withdraw.status.update', ['id' => encrypt($withdraw_request->id), 'status' => 'reject']) }}" class="dropdown-item ">Reject</a>
                                               
                                            </div>
                                        </div>

                                        <div class="account">
                                            <a 
                                            onclick="withdrawMethod({{ $withdraw_request->id }})"
                                            class="btn btn-sm btn-primary" 
                                            href="#" 
                                            data-toggle="modal" 
                                            data-target="#withdrawAccountModal">
                                                
                                                Account
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                @empty 
                                    <tr>
                                        <td colspan="7" class="text-center">No data found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>

                    <div>
                            {{ $withdraw_requests->links() }}
                        </div>
                    
                </div><!--End card body-->
            </div><!--End card-->
        </div><!--End Col-->

    </div><!--End row-->

    <!-- Content Row -->

    <!--Modal --> 
    <div class="modal fade show" id="withdrawAccountModal" tabindex="-1" role="dialog" aria-labelledby="withdrawAccountModal" aria-modal="true" style="padding-right: 15px;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withdraw Method</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="withdrawAccountModalBody">
                    

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@section ('footer_scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>

    <script>
        function withdrawMethod(withdraw_request_id){

            $.ajax({
                url: "{{ route('admin.withdraw.payment.method') }}",
                data: {
                    withdraw_request_id: withdraw_request_id
                },
                success:function(res){
                    var html = '';
                    console.log("{{ $withdraw_request->payment_method }}")
                    html +='<table class="table table-bordered">'

                    if(res.name == 'Bkash'){

                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.bkash_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Type</th>'
                        html +='<td>'+res.bkash_account_type+'</td>'
                        html +='</tr>'

                    }else if(res.name == 'Nagad'){
                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.nagad_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Type</th>'
                        html +='<td>'+res.nagad_account_type+'</td>'
                        html +='</tr>'
                    }else if(res.name == 'Rocket'){
                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.rocket_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Type</th>'
                        html +='<td>'+res.rocket_account_type+'</td>'
                        html +='</tr>'
                    }else if(res.name == 'Cellfin'){
                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.cellfin_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Holder</th>'
                        html +='<td>'+res.cellfin_holder+'</td>'
                        html +='</tr>'
                    }else if(res.name == 'DBBL'){
                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.dbbl_ac_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Holder</th>'
                        html +='<td>'+res.dbbl_holder+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Branch</th>'
                        html +='<td>'+res.dbbl_branch+'</td>'
                        html +='</tr>'
                    }else if(res.name == 'IBBL'){
                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.ibbl_ac_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Holder</th>'
                        html +='<td>'+res.ibbl_holder+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Branch</th>'
                        html +='<td>'+res.ibbl_branch+'</td>'
                        html +='</tr>'
                    }else if(res.name == 'Bank Asia'){
                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.bank_asia_ac_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Holder</th>'
                        html +='<td>'+res.bank_asia_holder+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Branch</th>'
                        html +='<td>'+res.bank_asia_branch+'</td>'
                        html +='</tr>'
                    }else if(res.name == 'Dhaka Bank'){
                        html +='<tr>'
                        html +='<th width="20%">Method Name</th>'
                        html +='<td>'+res.name+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Account No</th>'
                        html +='<td>'+res.dhaka_ac_account+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Holder</th>'
                        html +='<td>'+res.dhaka_bank_holder+'</td>'
                        html +='</tr>'

                        html +='<tr>'
                        html +='<th width="20%">Branch</th>'
                        html +='<td>'+res.dhaka_bank_branch+'</td>'
                        html +='</tr>'
                    }


                    html +='</table>'

                    $('#withdrawAccountModalBody').html(html);
                }, 
                error:function(){
                    console.log('Cannot get payment method')
                }
            })
        }
    </script>
@endsection