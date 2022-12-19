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
       {{_('client')}} 
               <!--User profile sidebar -->
                @include('frontend.components.clients.dashboard-sidebar')
               <!--EndUser profile sidebar -->
                
            </div><!-- End Col-->

            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body p-0"> 

                        <div class="profile-right-area">
                            <div class="profile-header primary-bg-color p-4">
                                <h4  class="title text-white">Favourite gigs</h4>
                                <!-- <p class="text-white mb-0">Report Overview</p> -->
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              
                <div class="row">

                    @forelse($favourite as $key => $fav_gig)
                    <div class="col-md-3 my-2 ">
                        @include('frontend.components.gig-card',['gig' => $fav_gig->gig, 'gig_favourite'=> $fav_gig,  'link' => 'gig.view'])
                    </div><!--End col-->   
                    @empty
                    {{__('no favourite gigs')}}

                   @endforelse
                    
                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection