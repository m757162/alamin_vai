@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}">
@endsection

@section('content')
<section class="profile-section">
    <div class="container" data-aos="fade-up">

        <div class="row"> 

            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-body p-0"> 

                        <div class="profile-right-area">
                            <div class="profile-header primary-bg-color p-4">
                                <h4  class="title text-white">Gigs</h4>
                                <p class="text-white mb-0">{{ $gig->category ? $gig->category->name : '' }} {{ $gig->subcategory ? '> '.$gig->subcategory->name : ''  }} {{ $gig->subsubcategory ? '> '.$gig->subsubcategory->name : '' }}</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row my-4">
                 
                    <!--Content going here -->
                    <div class="col-md-8">
                        @php 
                            $image_decode = json_decode($gig->image, true);
                            $image = $image_decode[0];
                        @endphp

                        <div class="gig-title my-3">
                            <h4>{{ $gig->title }}</h4>
                        </div>

                        <div class="gig-image mb-3">
                            <img src="{{ asset('storage/'.$image) }}" class="img-thumbnail" width="100%" alt="{{ $gig->title }}">
                        </div>

                        <article>                            
                            <p>{{ $gig->description }}</p>
                        </article>
                            <!-- for gig favourite -->
                        @if($gig_favourite !== NULL)
                            @if ($gig_favourite->gig_id == $gig->id)
                            <form action="{{ route('gig.favourite.remove',['gig'=> $gig->id]) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn"><i class="bi bi-heart-fill" style="color: #008374;"></i></button>
                            </form>
                            @else
                            <form action="{{ route('gig.favourite',['gig'=> $gig->id]) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn "><i class="bi bi-heart" style="color: #008374;"></i></button>
                            </form>
                            @endif
                            @else
                            <form action="{{ route('gig.favourite',['gig'=> $gig->id]) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn "><i class="bi bi-heart" style="color: #008374;"></i></button>
                            </form>
                        @endif
                    </div>

                    <div class="col-md-3">
                       <div class="gig-content mt-5 ">
                            @auth
                                @if(Auth::guard('web')->user()->user_type == 'freelancer')
                                    <div class="d-grid my-3">
                                        <a href="{{ route('user.gigs.edit', encrypt($gig->id)) }}" class="btn primary-bg-color primary-hover text-white">Edit</a>
                                    </div>
                                @endif
                            @endauth
                            
                            <div class="d-flex justify-content-between">
                                <p><b>Total Sale</b> </p>
                                <p>{{ $gig->sales_count }}</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p><b>Views</b> </p>
                                <p>{{ $gig->view }}</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p><b>Price</b> </p>
                                <p>{{ $gig->price }}</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p><b>Estimate Day</b> </p>
                                <p>{{ $gig->estimate_day }} Days</p>
                            </div>

                            <div class="d-flex justify-content-between ">
                                <p><b>Rating</b> </p>
                                @if($gig->rate != null)
                                    @if($gig->rate->freelancer_rate == 1)
                                        <div class="rating">
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                        </div>
                                    @elseif($gig->rate->freelancer_rate == 2)
                                        <div class="rating">
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                        </div>
                                    @elseif($gig->rate->freelancer_rate == 3)
                                        <div class="rating">
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                        </div>
                                    @elseif($gig->rate->freelancer_rate == 4)
                                        <div class="rating">
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star"></i></span>
                                        </div>
                                    @elseif($gig->rate->freelancer_rate == 5)
                                        <div class="rating">
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                            <span><i class="bi bi-star-fill text-warning"></i></span>
                                        </div>
                                    @endif 
                                @else
                                    <div class="rating">
                                        <span><i class="bi bi-star"></i></span>
                                        <span><i class="bi bi-star"></i></span>
                                        <span><i class="bi bi-star"></i></span>
                                        <span><i class="bi bi-star"></i></span>
                                        <span><i class="bi bi-star"></i></span>
                                    </div> 
                                @endif 
                            </div>
                           
                       </div>
                    </div>
                    <!--Content end here -->

                </div><!--End row-->

            </div><!--End col-->

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
       
                <!--User profile sidebar -->
                 @include('frontend.components.gig-sidebar', ['gig' => $gig])
                <!--EndUser profile sidebar -->
                 
            </div><!-- End Col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection

@section('footer_scripts')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=1387774524963966&autoLogAppEvents=1" nonce="bOvdt4HW"></script> 
@endsection 