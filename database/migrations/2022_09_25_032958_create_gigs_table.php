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
        Schema::create('gigs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('subsubcategory_id')->nullable()->constrained('subsub_categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('estimate_day')->default(1);
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->integer('sales_count')->default(0)->nullable();
            $table->integer('rating')->default(0)->nullable();
            $table->string('tag')->nullable();
            $table->integer('view')->default(0)->nullable();
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('gigs');
    }
};
