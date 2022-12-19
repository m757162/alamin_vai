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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->boolean('status')->default(false)->nullable();
            $table->mediumText('api_key')->nullable();
            $table->mediumText('server_key')->nullable();
            $table->mediumText('public_key')->nullable();
            $table->mediumText('private_key')->nullable();
            $table->mediumText('secret_key')->nullable();            
            $table->mediumText('callback_url')->nullable();            
            $table->mediumText('payment_domain')->nullable();            
            $table->mediumText('webhook_url')->nullable();            
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
        Schema::dropIfExists('payment_methods');
    }
};
