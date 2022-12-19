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
                                <h4  class="title text-white">Payment Methods</h4>
                                <p class="text-white mb-0">Update your payment methods</p>
                            </div>
                        </div><!--End profile right end-->

                    </div><!--End card-body-->
                </div><!--End card-->                   
              

                <div class="row">

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>Bkash</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="bkash_account" id="bkash_account" @if($withdraw_pay_method->bkash_account != null) value="{{ $withdraw_pay_method->bkash_account }}" @else placeholder="+88017xxxxxxx" @endif>
                                        <label for="bkash_account">Bkash Account</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="bkash_account_type">
                                            <option value="">Choose</option>
                                            <option @if($withdraw_pay_method->bkash_account_type == 'Agent') selected @endif value="Agent">Agent</option>
                                            <option @if($withdraw_pay_method->bkash_account_type == 'Personal') selected @endif value="Personal">Personal</option>
                                        </select>
                                        <label for="bkash_account">Bkash Account Type</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="bkash_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->bkash_status == 'active') selected @endif>Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->bkash_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="bkash_status">Status</label>
                                    </div>
                                  
                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                    </div>
                                </form><!--End Form-->

                            </div><!--End card-body-->
                        </div><!--End Card-->
                        
                    </div><!--End col-->

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>Nagad</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="nagad_account" id="nagad_account" @if($withdraw_pay_method->nagad_account != null) value="{{ $withdraw_pay_method->nagad_account }}" @else placeholder="+88017xxxxxxx" @endif>
                                        <label for="nagad_account">Nagad Account</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="nagad_account_type">
                                            <option value="">Choose</option>
                                            <option value="Agent" @if($withdraw_pay_method->nagad_account_type == 'Agent') selected @endif >Agent</option>
                                            <option value="Personal" @if($withdraw_pay_method->nagad_account_type == 'Personal') selected @endif>Personal</option>
                                        </select>
                                        <label for="nagad_account_type">Nagad Account Type</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="nagad_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->nagad_status == 'active') selected @endif>Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->nagad_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="nagad_status">Status</label>
                                    </div>
                                  
                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                    </div>
                                </form><!--End Form-->

                            </div><!--End card-body-->
                        </div><!--End Card-->
                        
                    </div><!--End col-->

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>Rocket</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="rocket_account" id="rocket_account" @if($withdraw_pay_method->rocket_account != null) value="{{ $withdraw_pay_method->rocket_account }}" @else placeholder="+88017xxxxxxx" @endif>
                                        <label for="rocket_account">Rocket Account</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="rocket_account_type">
                                            <option value="">Choose</option>
                                            <option value="Agent" @if($withdraw_pay_method->rocket_account_type == 'Agent') selected @endif>Agent</option>
                                            <option value="Personal" @if($withdraw_pay_method->rocket_account_type == 'Personal') selected @endif>Personal</option>
                                        </select>
                                        <label for="bkash_account">Rocket Account Type</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="rocket_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->rocket_status == 'active') selected @endif>Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->rocket_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="rocket_status">Status</label>
                                    </div>
                                  
                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                    </div>
                                </form><!--End Form-->

                            </div><!--End card-body-->
                        </div><!--End Card-->
                        
                    </div><!--End col-->

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>Cellfin</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="cellfin_account" id="cellfin_account" @if($withdraw_pay_method->cellfin_account != null) value="{{ $withdraw_pay_method->cellfin_account }}" @else placeholder="+88017xxxxxxx" @endif>
                                        <label for="cellfin_account">Cellfin</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="cellfin_holder" id="cellfin_holder" @if($withdraw_pay_method->cellfin_holder != null) value="{{ $withdraw_pay_method->cellfin_holder }}" @else placeholder="Mr. XYZ" @endif>
                                        <label for="cellfin_holder">Cellfin Holder Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="cellfin_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->cellfin_status == 'active') selected @endif>Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->cellfin_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="cellfin_status">Status</label>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                    </div>
                                </form><!--End Form-->

                            </div><!--End card-body-->
                        </div><!--End Card-->

                    </div><!--End col-->

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>DBBL Bank</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="dbbl_ac_account" id="dbbl_ac_account" @if($withdraw_pay_method->dbbl_ac_account != null) value="{{ $withdraw_pay_method->dbbl_ac_account }}" @else placeholder="+88017xxxxxxx" @endif>
                                        <label for="dbbl_ac_account">DBBL AC Account</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="dbbl_holder" id="dbbl_holder" @if($withdraw_pay_method->dbbl_holder != null) value="{{ $withdraw_pay_method->dbbl_holder }}" @else placeholder="Mr. XYZ" @endif>
                                        <label for="dbbl_holder">DBBL Holder Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="dbbl_branch" id="dbbl_branch" @if($withdraw_pay_method->dbbl_branch != null) value="{{ $withdraw_pay_method->dbbl_branch }}" @else placeholder="Mr. XYZ" @endif>
                                        <label for="dbbl_branch">Branch</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="dbbl_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->dbbl_status == 'active') selected @endif>Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->dbbl_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="dbbl_status">Status</label>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                    </div>
                                </form><!--End Form-->

                            </div><!--End card-body-->
                        </div><!--End Card-->
                        
                    </div><!--End col-->

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>IBBL Bank</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="ibbl_ac_account" id="ibbl_ac_account" @if($withdraw_pay_method->ibbl_ac_account != null) value="{{ $withdraw_pay_method->ibbl_ac_account }}" @else placeholder="20xxxxxxx" @endif>
                                        <label for="ibbl_ac_account">IBBL AC Account</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="ibbl_holder" id="ibbl_holder" @if($withdraw_pay_method->ibbl_holder != null) value="{{ $withdraw_pay_method->ibbl_holder }}" @else placeholder="Mr. XYZ" @endif>
                                        <label for="ibbl_holder">IBBL Holder Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="ibbl_branch" id="ibbl_branch" @if($withdraw_pay_method->ibbl_branch != null) value="{{ $withdraw_pay_method->ibbl_branch }}" @else placeholder="Dhaka" @endif>
                                        <label for="ibbl_branch">Branch</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="ibbl_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->ibbl_status == 'active') selected @endif>Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->ibbl_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="ibbl_status">Status</label>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                    </div>
                                </form><!--End Form-->

                            </div><!--End card-body-->
                        </div><!--End Card-->
                        
                    </div><!--End col-->

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>Bank Asia</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="bank_asia_ac_account" id="bank_asia_ac_account" @if($withdraw_pay_method->bank_asia_ac_account != null) value="{{ $withdraw_pay_method->bank_asia_ac_account }}" @else placeholder="20xxxxxxx" @endif>
                                        <label for="bank_asia_ac_account">Bank Asia AC Account</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="bank_asia_holder" id="bank_asia_holder" @if($withdraw_pay_method->bank_asia_holder != null) value="{{ $withdraw_pay_method->bank_asia_holder }}" @else placeholder="Mr. XYZ" @endif>
                                        <label for="bank_asia_holder">Bank Asia Holder Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="bank_asia_branch" id="bank_asia_branch" @if($withdraw_pay_method->bank_asia_branch != null) value="{{ $withdraw_pay_method->bank_asia_branch }}" @else placeholder="Dhaka" @endif>
                                        <label for="bank_asia_branch">Branch</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="bank_asia_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->bank_asia_status == 'active') selected @endif >Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->bank_asia_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="bank_asia_status">Status</label>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn primary-bg-color primary-hover text-white">Update</button>
                                    </div>
                                </form><!--End Form-->

                            </div><!--End card-body-->
                        </div><!--End Card-->
                        
                    </div><!--End col-->

                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 my-3 ">

                        <div class="card">
                            <div class="card-header">
                                <span>Dhaka Bank</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ route('freelancer.payment.update') }}" method="POST">
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" name="dhaka_ac_account" id="dhaka_ac_account" @if($withdraw_pay_method->dhaka_ac_account != null) value="{{ $withdraw_pay_method->dhaka_ac_account }}" @else placeholder="20xxxxxxx" @endif>
                                        <label for="dhaka_ac_account">Dhaka Bank AC Account</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="dhaka_bank_holder" id="dhaka_bank_holder" @if($withdraw_pay_method->dhaka_bank_holder != null) value="{{ $withdraw_pay_method->dhaka_bank_holder }}" @else placeholder="Mr. XYZ" @endif>
                                        <label for="dhaka_bank_holder">Dhaka Bank Holder Name</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="dhaka_bank_branch" id="dhaka_bank_branch" @if($withdraw_pay_method->dhaka_bank_branch != null) value="{{ $withdraw_pay_method->dhaka_bank_branch }}" @else placeholder="Dhaka" @endif>
                                        <label for="dhaka_bank_branch">Branch</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="dhaka_bank_status">
                                            <option value="">Choose</option>
                                            <option value="active" @if($withdraw_pay_method->dhaka_bank_status == 'active') selected @endif>Active</option>
                                            <option value="deactive" @if($withdraw_pay_method->dhaka_bank_status == 'deactive') selected @endif>Deactive</option>
                                        </select>
                                        <label for="dhaka_bank_status">Status</label>
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
