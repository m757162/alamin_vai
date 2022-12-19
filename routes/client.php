<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Client\OrderController;
use App\Http\Controllers\Frontend\Client\ClientController; 
use App\Http\Controllers\Frontend\Client\RateController; 
use App\Http\Controllers\Frontend\Client\ChatController;
use App\Http\Controllers\Frontend\Client\BuyerRequestController;
use App\Http\Controllers\SendMessageController;

Route::group(['middleware' => 'auth', 'as' => 'clients.'], function(){
    Route::controller(OrderController::class)->group(function(){
        Route::get('/order/accept/', 'accept_order')->name('order.accept');
    });

    Route::controller(ClientController::class)->group(function() {
        Route::get('transaction', 'transaction')->name('transaction');
        Route::get('favourite', 'favourite')->name('favourite');
    }); 

    Route::controller(RateController::class)->group(function() {
        Route::get('rate', 'rate')->name('rate');
    }); 

    //Buyer Request
    Route::resource('buyer-request', BuyerRequestController::class);

    //Chat
    Route::controller(ChatController::class)->group(function() {
        Route::get('chat', 'chat')->name('chat');
        
    }); 

    //Send Message (Same route as admin)
    Route::controller(SendMessageController::class)->group(function() {
        Route::post('send-message', 'send_message');
        Route::get('messages', 'messages')->name('messages');
    }); 
});