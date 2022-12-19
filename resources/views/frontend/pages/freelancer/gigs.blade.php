@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-tagsinput.css') }}" />
    <style>

        .bootstrap-tagsinput .tag {
            background: #959595;
            border-radius: 4px;
        }
    </style>
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
                                <h4  class="title text-white">Gigs</h4>
                                <p class="text-white mb-0">Perfect gigs can increase sells</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">
                    @forelse($gigs as $key => $gig)
                        <div class="col-md-4 my-2">
                            @include('frontend.components.gig-card-user',['link' => 'gig.view', 'gig' => $gig])
                        </div><!--End col-->                       
                        
                    @empty 
                    <div class="my-2">
                        <p>No gig create yet!</p>
                    </div>
                    @endforelse

                    {{-- <div class="col-md-12">
                        <div class="pagin my-3">
                            {{ $gigs->links() }}
                        </div>
                    </div> --}}

                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection
