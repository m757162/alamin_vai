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
                                <h4  class="title text-white">Refer Program</h4>
                                <p class="text-white mb-0">Refer your friend and make money</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">

                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            
                            <div class="card-body">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ env('APP_URL') }}?refer={{ auth()->user()->refer_code }}" id="refer_link" readonly>
                                    <button class="btn secondary-bg-color secondary-hover text-white" onclick="copyText()" >Copy</button>
                                    <small class="text-danger" id="copied"></small>
                                </div>

                            </div><!--End card-body-->
                        </div><!--End Card-->
                        
                    </div><!--End col-->


                </div><!--End row-->

            </div><!--End col-->

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection

@section('footer_scripts')
    <script>
        function copyText() {
            // Get the text field
            var copyText = document.getElementById("refer_link");

            // // Select the text field
            // copyText.select();
            // copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            let copied = document.getElementById("copied")
            copied.value = 'Copied!'
        }
    </script>
@endsection 