@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}">
@endsection

@section('content')
<section class="profile-section">
    <div class="container" data-aos="fade-up">

        <div class="row">        

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
       
               <!--User profile sidebar -->
                @include('frontend.components.clients.dashboard-sidebar')
               <!--EndUser profile sidebar -->
                
            </div><!-- End Col-->

            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body p-0"> 

                        <div class="profile-right-area">
                            <div class="profile-header primary-bg-color p-4">
                                <h4  class="title text-white">Transactions</h4>
                                <p class="text-white mb-0">Your transaction history will be found there</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 my-3">
                        <div class="table-responsive">
                            <table class="table">
                                
                                <thead>
                                    <tr>
                                        <th width="10%" scope="col">#</th>
                                        <th width="15%">Type</th>
                                        <th width="30%">Amount</th>
                                        <th width="30%">Description</th>                                        
                                        <th width="15%">Date</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                        
                                    @forelse($transactions as $key => $transaction)
                                        
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>
                                                @if($transaction->type == 'debit')
                                                    <span class="badge text-bg-success">Debit</span>                                                
                                                @elseif($transaction->type == 'credit')
                                                    <span class="badge text-bg-danger">Credit</span>
                                                @endif
                                            </td>       
                                            <td>{{ currency_symbol().' '.$transaction->amount }}</td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>{{ date('M d'.','. ' Y', strtotime($transaction->created_at)) }}</td>
                                           
                                        </tr>
                                                                        
                                    @empty 
                                        <tr>
                                            <td colspan="5" class="text-center">No transaction found!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                        </div><!--End responsive-->

                        <div class="pagination">
                            {{ $transactions->links() }}
                        </div>
                    </div><!--End col-->

                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection