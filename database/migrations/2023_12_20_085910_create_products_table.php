<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_title');
            $table->string('product_code');
            $table->integer('category')->nullable();
            $table->integer('subcategory')->nullable();
            $table->string('brand')->nullable();
            $table->integer('selling_price');
            $table->integer('discount_price');
            $table->text('video_url')->nullable();
            $table->text('main_thumbnail');
            $table->boolean('status')->default(1);
            $table->boolean('top_review')->default(0);
            $table->boolean('best_sell')->default(0);
            $table->boolean('exclusive_template')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
