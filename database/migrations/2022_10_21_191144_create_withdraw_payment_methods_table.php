<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade');
            $table->string('bkash_account')->nullable();
            $table->string('bkash_account_type')->nullable();
            $table->string('bkash_status')->nullable();
            
            $table->string('nagad_account')->nullable();
            $table->string('nagad_account_type')->nullable();
            $table->string('nagad_status')->nullable();
            
            $table->string('rocket_account')->nullable();
            $table->string('rocket_account_type')->nullable();
            $table->string('rocket_status')->nullable();
            
            $table->string('cellfin_account')->nullable();
            $table->string('cellfin_holder')->nullable();
            $table->string('cellfin_status')->nullable();
            
            $table->string('dbbl_ac_account')->nullable();
            $table->string('dbbl_holder')->nullable();
            $table->string('dbbl_branch')->nullable();
            $table->string('dbbl_status')->nullable();
            
            $table->string('ibbl_ac_account')->nullable();
            $table->string('ibbl_holder')->nullable();
            $table->string('ibbl_branch')->nullable();
            $table->string('ibbl_status')->nullable();
            
            $table->string('bank_asia_ac_account')->nullable();
            $table->string('bank_asia_holder')->nullable();
            $table->string('bank_asia_branch')->nullable();
            $table->string('bank_asia_status')->nullable();
            
            $table->string('dhaka_ac_account')->nullable();
            $table->string('dhaka_bank_holder')->nullable();
            $table->string('dhaka_bank_branch')->nullable();
            $table->string('dhaka_bank_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw_payment_methods');
    }
};
