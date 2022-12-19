@extends('frontend.master')

@section('title', 'Login | Easy Bangladesh')

@section('header_css')
@endsection

@section('content')
<section >
    <div class="container" data-aos="fade-up">

        <div class="row gx-lg-0 gy-4">        

            <div class="col-lg-4 offset-lg-4">
                
                <div class="card shadow-lg">
                    <div class="card-body">  

                        <div class="text-center mb-3">
                            <h3>Sign In</h3>
                            <p>Weblcome back!</p>
                        </div>
                        
                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
        
                        <form action="{{ route('user.login.action') }}" method="post" >
                            @csrf 
        
                            <div class="form-group mb-2">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
        
                            <div class="form-group mb-2">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-block">Sign In</button>
                            </div>
                        </form>

                        <div class="text-center mt-5">
                            <h6>Sign with</h6>
                        </div>
                        <hr>

                        <div class="d-grid gap-2 mb-3">

                            <a href="{{ url('auth/facebook') }}" class="btn facebook-bg-color facebook-btn-hover text-white"><i class="bi bi-facebook"></i> Facebook</a>
                            <a href="{{ url('auth/google') }}" class="btn google-bg-color google-btn-hover text-white"><i class="bi bi-google"></i> Google</a>
                            <a href="{{ route('auth.twitter') }}" class="btn twitter-bg-color twitter-btn-hover text-white"><i class="bi bi-twitter"></i> Twitter</a>
                            <a href="{{ url('auth/linkedin') }}" class="btn linkedin-bg-color linkedin-btn-hover text-white"><i class="bi bi-linkedin"></i> Linkedin</a>
                        </div>

                    </div><!--End card body-->
                </div><!--End Card-->
                
            </div><!-- End  -->

        </div>

    </div>
    </section>
@endsection

@section('footer_scripts')
    
<script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1387774524963966',
        cookie     : true,
        xfbml      : true,
        version    : 'v15.0'
      });
        
      FB.AppEvents.logPageView();   
        
    };
  
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
@endsection