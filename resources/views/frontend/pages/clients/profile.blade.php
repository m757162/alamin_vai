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
                @include('frontend.components.clients.sidebar')
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
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12 my-3 ">

                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('freelancer.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf 
                               
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}">
                                    <label for="name">Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}">
                                    <label for="email">Email</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-12" id="imageInputBox">
                                        <input type="file" name="image" id="image" onchange="filePreview(this)">
                                        <br><small class="fs-lighter"><i>Dimension ratio should be (1:1)</i></small>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="img-box my-2 mr-2" id="imgBox">
                                            <img id="profileImg" src="http://127.0.0.1:8000/placeholder.svg" alt="Profile Image" width="100%">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                </div>
                            </form><!--End Form-->


                            <form action="{{ route('freelancer.password.update') }}" method="POST" enctype="multipart/form-data" class="my-3">
                                @csrf
                               
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter old password">
                                    <label for="old_password">Old Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password">
                                    <label for="password">Password</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>


                                <div class="d-grid">
                                    <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                </div>
                            </form><!--End Form-->

                        </div><!--End card-body-->
                    </div><!--End Card-->

                    </div><!--End col-->
                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection

