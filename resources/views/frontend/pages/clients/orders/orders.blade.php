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
                                <h4  class="title text-white">Orders</h4>
                                <p class="text-white mb-0">Your all order will be found there</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">
                    <div class="col-md-12 my-2">
                        <table class="table">
                            @if(!empty($hires))
                                <thead>
                                    <tr>
                                        <th width="5%" scope="col">#</th>
                                        <th width="10%">Freelancer</th>
                                        <th width="10%">Gigs</th>
                                        <th width="10%" class="text-center">Delivery Date</th>
                                        <th width="10%" class="text-center">Delivered</th>
                                        <th width="10%" class="text-center">Total</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                            @endif 

                            <tbody>
                    
                                @forelse($hires as $key => $hire)
                                    
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{ $hire->freelancer->name }}</td>
                                        <td>{{ $hire->gig->title }}</td>
                                        <td class="text-center">{{ date('M d'.','. ' Y', strtotime($hire->order->estimate_date)) }}</td>
                                        <td class="text-center"> 
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
                                        <td class="text-center fs-bold"> {{ currency_symbol().$hire->order->total_amount }}</td>
                                        <td class="text-center">
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
                    </div><!--End col-->

                    <div class="col-md-12">
                        <div class="pagin my-3">
                            {{ $hires->links() }}
                        </div>
                    </div>

                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection