@extends('frontend.master')

@section('title', 'Email Verify | Easy Bangladesh')

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
                            <h3>Account Verification!</h3>
                            <p>Weblcome back!</p>
                        </div>
                                
                        <div class="d-grid verify">
                            <a href="{{ route('user.send.email.verification') }}" class="btn primary-bg-color primary-hover text-white">Verify</a>
                        </div>
                        
                    </div><!--End card body-->
                </div><!--End Card-->
                
            </div><!-- End  -->

        </div>

    </div>
    </section>
@endsection
