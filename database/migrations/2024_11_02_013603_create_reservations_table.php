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
        Schema::create('reservations', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->dateTime('checkin');
            $table->dateTime('checkout');
            $table->tinyInteger('adults')->nullable();
            $table->tinyInteger('childs')->nullable();
            $table->tinyInteger('pets')->nullable();
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('additional_info')->nullable();
            $table->tinyInteger('booking_source_id')->nullable();
            $table->string('doorcode')->nullable();
            $table->decimal('rateperday', 9, 2)->nullable();
            $table->tinyInteger('daystay')->nullable();
            $table->decimal('meals_total', 9, 2)->nullable();
            $table->decimal('additional_services_total', 9, 2)->nullable();
            $table->decimal('subtotal', 9, 2)->nullable();
            $table->decimal('discount', 9, 2)->nullable();
            $table->decimal('tax', 9, 2)->nullable();
            $table->decimal('grandtotal', 9, 2)->nullable();
            $table->tinyInteger('payment_type_id')->nullable();
            $table->decimal('prepayment', 9, 2)->nullable();
            $table->tinyInteger('payment_status_id')->nullable();
            $table->decimal('balancepayment', 9, 2)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('host_id');
            $table->tinyInteger('booking_status_id')->nullable();
            $table->tinyInteger('currency_id')->nullable();
            $table->timestamps();

            $table->index('host_id', 'host_id');
            $table->index('checkin', 'checkin');
            $table->index('checkout', 'checkout');
            $table->index('fullname', 'fullname');
            $table->index('email', 'email');
            $table->index('phone', 'phone');
            $table->index('grandtotal', 'grandtotal');
            $table->index('payment_status_id', 'payment_status_id');
            $table->index('booking_status_id', 'booking_status_id');
            $table->index('user_id', 'user_id');
            $table->index('booking_source_id', 'booking_source_id');
            $table->index('currency_id', 'currency_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
