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
        Schema::table('buyer_requests', function (Blueprint $table) {
            $table->foreignId('subcategory_id')->nullable()->change();
            $table->foreignId('subsubcategory_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer_requests', function (Blueprint $table) {
            //
        });
    }
};
