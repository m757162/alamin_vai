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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hire_id')->constrained()->onDelete('cascade');
            $table->decimal('commission_amount', 10, 2)->default(0)->nullable();
            $table->decimal('freelancer_amount', 10, 2)->default(0)->nullable();
            $table->decimal('total_amount', 10, 2)->default(0)->nullable()->comment('Escrow amount from client');
            $table->enum('payment_status',['paid', 'unpaid'])->default('unpaid');
            $table->string('delivery_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->text('payment_info')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('file')->nullable();
            $table->boolean('is_accept')->default(false)->nullable();
            $table->enum('is_delivered', ['delivered', 'accept_delivery', 'not_accept'])->nullable()->comment('delivery by freelancer, accept by client');
            $table->timestamp('estimate_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
