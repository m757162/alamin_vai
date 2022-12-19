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
        Schema::create('admin_wallets', function (Blueprint $table) {
            $table->id();
            $table->decimal('commission_amount', 20, 2)->default(0)->nullable();
            $table->decimal('promote_amount', 20, 2)->default(0)->nullable();
            $table->decimal('balance', 20, 2)->default(0)->nullable()->comment('Received Escrow Amount from client');
            $table->decimal('freelancer_withdraw', 20, 2)->default(0)->nullable()->comment('Freelancer Withdraw Amount');
            $table->decimal('refund_to_client', 20, 2)->default(0)->nullable()->comment('Refund to client');
            $table->decimal('total_income', 20, 2)->default(0)->nullable()->comment('Admin Income');
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
        Schema::dropIfExists('admin_wallets');
    }
};
