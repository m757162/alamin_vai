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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('referral_id')->nullable();
            $table->string('refer_code')->nullable();
            $table->integer('total_refers')->default(0);
            $table->integer('total_refer_claim')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('referral_id');
            $table->dropColumn('refer_code');
            $table->dropColumn('total_refers');
            $table->dropColumn('total_refer_claim');
        });
    }
};
