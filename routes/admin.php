<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\SubsubCategoryController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\Freelancer\WithdrawController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ChattingController;
use App\Http\Controllers\SendMessageController;

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'login')->name('admin.login');
    Route::post('/login/action', 'login_action')->name('admin.login.action');
});

Route::group(['middleware' => 'admin', 'as' => 'admin.'], function(){    
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/', 'dashboard')->name('dashboard');        
    });

    Route::controller(LoginController::class)->group(function(){
        Route::get('/logout', 'logout')->name('logout');
    });   

    //Category Manage
    Route::resource('categories', CategoryController::class);

    //Sub Category Manage
    Route::resource('subcategories', SubcategoryController::class);

     //Subsub Category Manage
     Route::resource('subsubcategories', SubsubCategoryController::class);

    //Transaction
    Route::controller(TransactionController::class)->group(function(){
        Route::get('/transactions', 'transactions')->name('transactions');        
    });

    //Orders
    Route::controller(OrderController::class)->group(function(){
        Route::get('/orders', 'orders')->name('orders');
        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function(){            
            Route::get('/show/{id}', 'show_order')->name('show');
        });                
    });

    //withdraw
    Route::controller(WithdrawController::class)->group(function(){
        Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function(){
            Route::get('/withdraw/requests', 'withdraw_requests')->name('requests');
            Route::get('/withdraw/status/{id}/{status}', 'withdraw_status_update')->name('status.update');
            Route::get('/withdraw/payment-method', 'withdraw_payment_method')->name('payment.method');
        });
        
    });

    //Settings
    Route::controller(SettingsController::class)->group(function(){
        Route::get('/settings', 'settings')->name('settings');        
        Route::put('/settings', 'update_settings')->name('settings');        
    });

    //Permissions
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions-edit', [PermissionController::class, 'permission'])->name('permissions.permission-edit');
    Route::post('permissions-update', [PermissionController::class, 'updatePermission'])->name('permissions.updatePermission');
    
     //Roles
     Route::resource('roles', RoleController::class);
     Route::get('role-edit', [RoleController::class, 'role'])->name('roles.roles-edit');
     Route::post('role-update', [RoleController::class, 'updateRole'])->name('roles.updateRole');

    //Employee
    Route::resource('employees', EmployeeController::class);
    Route::get('employees-edit', [EmployeeController::class, 'employees'])->name('employees.employees-edit');
    Route::post('employees-update', [EmployeeController::class, 'update_employees'])->name('employees.update-employees');

    //Chat
    Route::get('chatting', [ChattingController::class, 'chatting'])->name('chatting');

    //Send Message (Same route as client)
    Route::controller(SendMessageController::class)->group(function() {
        Route::post('send-message', 'send_message');
        Route::get('messages', 'messages')->name('messages');
    }); 
});


