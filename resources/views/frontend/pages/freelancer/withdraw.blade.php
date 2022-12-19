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
                                <h4  class="title text-white">Withdraw</h4>
                                <p class="text-white mb-0">Withdraw your income</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">

                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('freelancer.withdraw.action') }}" method="POST">
                                    @csrf 

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="balance" id="balance" value="{{ $balance }}" readonly>
                                        <label for="balance">Balance</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="payment_method">
                                            <option value="">Choose Method</option>
                                            <option value="Bkash">Bkash</option>
                                            <option value="Nagad">Nagad</option>
                                            <option value="Rocket">Rocket</option>
                                            <option value="Cellfin">Cellfin</option>
                                            <option value="DBBL">DBBL</option>
                                            <option value="IBBL">IBBL</option>
                                            <option value="Bank Asia">Bank Asia</option>
                                            <option value="Dhaka Bank">Dhaka Bank</option>
                                        </select>
                                        <label for="payment_method">Payment Method</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="amount" id="amount" min="100" max="10000" placeholder="0.00">
                                        <label for="amount">Enter withdraw amount</label>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Withdraw</button>
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
