@extends('frontend.master')

@section ('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-12  col-sx-12">

                <div class="payment-success">
                    <div class="card shadow">
                        <div class="card-header">
                            <span>Order</span>
                        </div>

                        <div class="card-body text-center">
                            <div class="icon">
                                <i style="font-size: 50px;" class="bi bi-exclamation-circle-fill secondary-text-color"></i>
                            </div>

                            <h2>Oops! Payment not complete!</h2>

                            <p>Your order placed successfully. Thank you for get service from us</p>

                            <a href="/" class="btn secondary-bg-color secondary-hover text-white mb-3">Back to home</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection