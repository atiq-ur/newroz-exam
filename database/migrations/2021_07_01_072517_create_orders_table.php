<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('order_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_mobile_no');
            $table->string('customer_delivery_address');
            $table->float('discount_price')->nullable();
            $table->boolean('used_coupon')->default(false);
            $table->tinyInteger('order_status')
                ->comment('0-pending | 1-confirm | 2-Cancel')
                ->default(0);
            $table->string('payment_method')->nullable();
            $table->boolean('is_paid')->nullable();
            $table->string('ip_address')->nullable();
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
}
