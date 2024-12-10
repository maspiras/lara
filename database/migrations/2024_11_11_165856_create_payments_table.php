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
        Schema::create('payments', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('host_id');
            $table->unsignedBigInteger('user_id');
            $table->string('ref_number');
            $table->unsignedBigInteger('reservation_id');
            $table->mediumInteger('currency_id');
            $table->tinyInteger('payment_type_id');
            $table->tinyInteger('action_type_id'); /* 1=prepayment, 2=partial, 3=Fully payment, 4=refunded */
            $table->decimal('amount', 9, 2);
            $table->decimal('balance', 9, 2)->nullable();
            $table->timestamp('added_on');

            $table->index('host_id', 'host_id');
            $table->index('user_id', 'user_id');
            $table->index('currency_id', 'currency_id');
            $table->index('payment_type_id', 'payment_type_id');
            $table->index('reservation_id', 'reservation_id');            
            $table->index('added_on', 'added_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
