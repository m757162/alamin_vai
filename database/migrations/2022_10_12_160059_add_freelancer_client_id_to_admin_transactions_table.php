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
        Schema::table('admin_transactions', function (Blueprint $table) {
            $table->foreignId('freelancer_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
            $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_transactions', function (Blueprint $table) {
            $table->dropColumn('freelancer_id');
            $table->dropColumn('client_id');
            $table->dropColumn('deleted_at');
        });
    }
};
