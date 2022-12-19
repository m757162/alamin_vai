@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/payment.css') }}">
@endsection

@section('content')
<form action="{{ route('user.hire') }}" method="post" id="hireForm">
    @csrf 

    <section class="profile-section">
        <div class="container" data-aos="fade-up">

            <div class="row">        

                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <table class="table">
                        @if(!empty($gig))
                            <thead>
                            <tr>
                                <th scope="col" width="20%">Image</th>
                                <th scope="col" width="60%">Gig</th>
                                <th scope="col" width="20%">Freelancer</th>
                            </tr>
                            </thead>
                        @endif 

                        <tbody>
                            @if(!empty($gig))
                                <tr>
                                    <td>
                                        @php 
                                            $image_decode = json_decode($gig->image, true);
                                            $image = $image_decode[0];
                                        @endphp

                                        @if($gig->image != NUll)
                                            <img src="{{ asset('storage/'.$image) }}" width="80" alt="{{ $gig->title }}">
                                        @else 
                                            <img src="{{ asset('placeholder.svg') }}" width="80" alt="Gig Title">
                                        @endif 
                                    </td>
                                    <td>{{ $gig->title }}</td>
                                    <td>{{ $gig->freelancer->name }}</td>
                                </tr>
                            @endif                        

                            @if(empty($gig))
                                <tr>
                                    <td>
                                        <p>No selected gig found!</p>
                                    </td>
                                </tr>
                            @endif 
                        
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Payment Methods</h5>
                            <hr>
                        </div>                        
                    </div><!--End Row-->

                    <div class="row">
                        <div class="col-md-6 offset-md-3 my-3">
                            <h5><b>Wallet Balance :</b> {{ currency_symbol() }}<span>{{ \App\Models\ClientWallet::where('client_id', auth()->user()->id)->first()->balance }}</span></h5>
                        </div><!--End Col-->
                        <hr>
                        
                    </div>

                    <!-- Payment method value -->
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="payment_method" id="payment_method" value="">
                        </div>
                    </div>
                    <!--End Payment method value-->

                    <div class="row justify-content-center mb-4 radio-group">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-3 col-5">
                            <div class='radio mx-auto' data-value="wallet"> 
                                <img class="fit-image" src="{{ asset('frontend/assets/payment_method/wallet.webp') }}" title="Wallet Pay" width="100px" height="80px">                                
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-3 col-5">
                            <div class='radio mx-auto' data-value="sslcommercz"> 
                                <img class="fit-image" src="{{ asset('frontend/assets/payment_method/sslcommercz.png') }}" title="Uddokta Pay" width="100px" height="80px">
                            </div>
                        </div>

                    
                        <br>
                    </div>

                
                </div><!--End col-->

                @if(!empty($gig))
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">       
                        <!--User profile sidebar -->
                        @include('frontend.components.hire-cart', ['gig' => $gig])
                        <!--EndUser profile sidebar -->
                        
                    </div><!-- End Col-->
                @endif

            </div><!--End Row-->
        </div><!--End Container-->
        

    </section>
</form>

@endsection

@section('footer_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
        $(document).ready(function(){
            
            // select payment method
            $('.radio-group .radio').click(function(){
                $(this).parent().parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');

                //select payment method value
                let payment_method_value = $(this).data('value')                
                $('#payment_method').val(payment_method_value)                 
            });
        })
        
        function submitForm(){
            let payment_method_value = $('#payment_method').val()
            console.log(payment_method_value)

            if(payment_method_value.length == 0){
                alert('select Payment method')
                Abort();
            }else{
                hireForm.submit();
            }
        }

        function Abort()
        {
            throw new Error('Stop execution');
        }

        
    </script>
@endsection