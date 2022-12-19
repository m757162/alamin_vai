@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/dashboard.css') }}">
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
                                <h4  class="title text-white">Overview</h4>
                                <p class="text-white mb-0">Report Overview</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">


                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 my-3">
                        <div class="card overview-card-balance border-0 card-shadow py-3">
                            
                            <div class="card-body text-center text-white">
                                <h5 class="card-title">Balance</h5>
                                <h3>{{ currency_symbol() }} {{ $freelancer_wallet== NULL ? "0": $freelancer_wallet->balance}}</h3>
                             
                            </div>
                        </div><!--End Card-->
                    </div><!--End col-->

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 my-3">
                        <div class="card overview-active-orders border-0 card-shadow py-3">
                            
                            <div class="card-body text-center text-white">
                                <h5 class="card-title">Active Order</h5>
                                <h3>{{ $active_orders }}</h3>
                             
                            </div>
                        </div><!--End Card-->
                    </div><!--End col-->

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 my-3">
                        <div class="card overview-completed-orders border-0 card-shadow py-3">
                            
                            <div class="card-body text-center text-white">
                                <h5 class="card-title">Completed Order</h5>
                                <h3>{{ $completed_orders }}</h3>
                             
                            </div>
                        </div><!--End Card-->
                    </div><!--End col-->

                    


                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection
