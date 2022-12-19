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
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>Send offer</h3>
                <hr>
            </div>
        </div><!--End Row--->  

        <div class="row"> 
            
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <form action="{{ route('freelancer.send-offer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <input type="hidden" name="buyer_request_id" value="{{ $buyer_request_id }}">

                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="offer_letter" id="offer_letter" ></textarea>
                        <label for="offer_letter">Offer Letter</label>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="budget" id="budget" placeholder="0">
                                <label for="budget">Budget</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="estimate_date" id="estimate_date">
                                <label for="estimate_date">Estimate Date</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-grid">
                                <button type="submit" class="btn primary-bg-color primary-hover text-white">Send</button>
                            </div>
                        </div>
                    </div>
                </form><!--End Form-->

            </div>

        </div><!--End Row-->
    </div><!--End Container-->

    </section>
@endsection

@section('footer_scripts')
@endsection