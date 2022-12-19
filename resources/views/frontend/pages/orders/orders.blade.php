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
                @include('frontend.components.users.dashboard-sidebar')
               <!--EndUser profile sidebar -->
                
            </div><!-- End Col-->

            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body p-0"> 

                        <div class="profile-right-area">
                            <div class="profile-header primary-bg-color p-4">
                                <h4  class="title text-white">Orders</h4>
                                <p class="text-white mb-0">Your orders will be found there</p>
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
                                        <th width="3%" scope="col">#</th>
                                        <th width="7%">Clients</th>
                                        <th width="15%">Gigs</th>
                                        <th width="10%">Status</th>                                        
                                        <th width="10%">Delivery Date</th>
                                        <th width="10%">Delivered</th>
                                        <th width="10%">Total</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                        
                                    @forelse($hires as $key => $hire)
                                        
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $hire->client->name }}</td>
                                            <td>{{ $hire->gig->title }}</td>

                                            <td>
                                                @if($hire->order->is_accept == 1)
                                                    <span class="badge text-bg-success">Accepted</span>                                                
                                                @else 
                                                    <span class="badge text-bg-danger">Pending</span>
                                                @endif
                                            </td>                                            

                                            <td>{{ date('M d'.','. ' Y', strtotime($hire->order->estimate_date)) }}</td>
                                            <td>
                                                @if($hire->order->is_delivered == 'delivered')
                                                    <span class="badge text-bg-secondary">Pending</span>
                                                @elseif($hire->order->is_delivered == 'accept_delivery')
                                                    <span class="badge text-bg-success">Delivered</span>
                                                @elseif($hire->order->is_delivered == 'not_accept')
                                                    <span class="badge text-bg-danger">Not Accept</span>
                                                @else
                                                    ---
                                                @endif 
                                            </td>
                                            <td> {{ currency_symbol().$hire->order->total_amount }}</td>
                                            <td>
                                                <a href="{{ route('user.order.view', encrypt($hire->id)) }}" class="btn primary-bg-color primary-hover text-white"><i class="bi bi-eye"></i></a>
                                            </td>
                                        </tr>
                                                                        
                                    @empty 
                                        <tr>
                                            <td colspan="6" class="text-center">No order found!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            
                        </div><!--End responsive-->

                        <div class="pagination">
                            {{ $hires->links() }}
                        </div>
                    </div><!--End col-->

                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection