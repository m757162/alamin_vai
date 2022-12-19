<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\GigController;
use App\Http\Controllers\Frontend\HireController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\Auth\GoogleController;
use App\Http\Controllers\Frontend\Auth\TwitterController;
use App\Http\Controllers\Frontend\Auth\FacebookController;
use App\Http\Controllers\Frontend\Auth\LinkedinController;
use App\Http\Controllers\Frontend\Freelancer\WithdrawController;
use App\Http\Controllers\Frontend\Freelancer\FreelancerController;
use App\Http\Controllers\Frontend\Freelancer\WithdrawPaymentMethodsController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Frontend\Client\BuyerRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('/find-gigs', 'find_gig')->name('find.gigs');
    Route::get('/find-gigs-end', 'find_gig_end')->name('find.gigs.end');
    Route::get('/gig/view/{title}/{id}', 'gig_view')->name('gig.view');   
    Route::post('/gig/favourite', 'gig_favourite')->name('gig.favourite'); 
    Route::post('/gig/favourite/delete', 'gig_favourite_delete')->name('gig.favourite.remove'); 

});

Route::controller(AuthController::class)->group(function(){
    Route::group(['middleware' => 'guest', 'prefix' => 'user', 'as' => 'user.'], function(){
        Route::get('/register', 'register')->name('register');
        Route::post('/register/action', 'register_action')->name('register.action');

        Route::get('/login', 'login_form')->name('login');
        Route::post('/login/action', 'login_action')->name('login.action');
    });
    
});

Route::controller(FacebookController::class)->group(function(){    
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::controller(LinkedinController::class)->group(function(){
    Route::get('auth/linkedin', 'redirectToLinkedin');
    Route::get('auth/linkedin/callback', 'handleLinkedinCallback');
});

Route::controller(TwitterController::class)->group(function(){
    Route::get('auth/twitter', 'redirectToTwitter')->name('auth.twitter');
    Route::get('auth/twitter/callback', 'handleTwitterCallback');
});

Route::controller(ProfileController::class)->group(function(){
    Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function(){
        Route::get('/logout', 'logout')->name('logout');
        //Email verification
        Route::get('email/verify', 'email_verify')->name('email.verify');
        Route::get('send/email/verification/link', 'email_verification')->name('send.email.verification');
        Route::get('email/verification/callback/{id}', 'email_verification_callback')->name('email.verification.callback');
        
        Route::group(['middleware' => 'emailVerified'], function(){
            Route::get('/profile', 'profile')->name('profile');
            Route::get('dashboard', 'dashboard')->name('dashboard');
        });    
        
        //User Update
        Route::group(['prefix' => 'update', 'as' => 'update.'], function(){
            Route::get('moto', 'moto')->name('moto');
            Route::get('description', 'description')->name('description');
            Route::get('skills', 'skills')->name('skills');
            Route::get('socials', 'socials')->name('socials');
            Route::post('certificate', 'update_certificate')->name('certificate');
            Route::get('get/certificate', 'get_certificate')->name('get_certificate');
        });

        Route::post('store/certificate', 'store_certificate')->name('store.certificate');
                
        Route::controller(OrderController::class)->group(function(){
            Route::get('/orders', 'orders')->name('orders');
            Route::get('/orders/view/{id}', 'order_view')->name('order.view');
            Route::get('/orders/status/update', 'update_order_status')->name('order.status.update');
        });

        //Hire 
        Route::controller(HireController::class)->group(function(){
            Route::get('freelancer/hire-view/{freelancer_id}/{gig_id}', 'hire_view')->name('hire.view');
            Route::post('hire', 'hire')->name('hire');
        });

         //Manage Order 
         Route::controller(OrderController::class)->group(function(){
                 //       
        });
                
        //Manage Gig
        Route::resource('/gigs', GigController::class);
        Route::get('/fetch/subcategory', [GigController::class, 'fetch_subcategory'])->name('fetch.subcategory');
        Route::get('/fetch/subsubcategory', [GigController::class, 'fetch_subsubcategory'])->name('fetch.subsubcategory');
    });

    Route::group(['middleware' => 'auth', 'prefix' => 'freelancer', 'as' => 'freelancer.'], function(){

        Route::controller(ProfileController::class)->group(function() {
            Route::post('profile/update', 'profile_update')->name('profile.update');
            Route::post('password/update', 'password_update')->name('password.update');
        });

        Route::controller(WithdrawController::class)->group(function() {
            Route::get('withdraw', 'withdraw')->name('withdraw');

            Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function(){
                Route::post('/request/action', 'withdraw_action')->name('action');
            
                //Withdraw Request
                Route::get('/request', 'withdraw_form')->name('request.form');
            });
            
            
        });

        //Biding
        Route::controller(BuyerRequestController::class)->group(function(){
            Route::get('buyer-request', 'buyer_request')->name('buyer-request');
            Route::get('send-offer/{buyer_request_id}', 'send_offer')->name('send-offer');
            //Biding
            Route::post('send-offer', 'send_offer_store')->name('send-offer.store');
            Route::get('bid-delete/{bid_id}', 'bid_delete')->name('bid.delete');
        });

        Route::controller(FreelancerController::class)->group(function() {
            Route::get('transaction', 'transaction')->name('transaction');
            Route::get('gigs', 'gigs')->name('gigs');
            Route::get('refer-program', 'refer_program')->name('refer.program');
        });

        Route::controller(WithdrawPaymentMethodsController::class)->group(function() {
            Route::group(['prefix' => 'payment', 'as' => 'payment.'], function(){
                Route::get('/methods', 'payment_methods')->name('methods');
                Route::put('/methods/update', 'update')->name('update');
            });
            
        });

    });
    
});



Route::get('success', function(){
    return view('frontend.pages.payment-success');
});

Route::get('failed', function(){
    return view('frontend.pages.payment-failed');
});


// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'sslcommercz']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('sslcommercz.pay');
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
