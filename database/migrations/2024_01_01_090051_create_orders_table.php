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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('customer_name');
            $table->integer('customer_phone');
            $table->string('customer_email');
            $table->string('customer_country')->nullable();
            $table->string('customer_address');
            $table->integer('customer_zipcode');
            $table->integer('customer_extra_phone')->nullable();
            $table->string('customer_city');
            $table->integer('total');
            $table->integer('subtotal');
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('after_discount')->nullable();
            $table->string('payment_type');
            $table->string('tax')->nullable();
            $table->string('shipping_charge');
            $table->integer('order_id');
            $table->string('date');
            $table->string('month');
            $table->string('year');
            $table->integer('status')->default(0)->comment('0=all','1=draft',  '2= pending', '3= incomming', '4= production','5=ready','6=pickedup','7=delivered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
