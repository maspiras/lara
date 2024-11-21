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
        Schema::create('reserved_meals', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('host_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reservation_id');
            $table->tinyInteger('meal_id');
            //$table->string('meal_adults')->nullable();
            $table->smallInteger('meal_adults'); 
            $table->smallInteger('meal_childs')->nullable(); 
            $table->decimal('amount', 9, 2)->nullable();
            $table->timestamp('added_on');

            $table->index('host_id', 'host_id');
            $table->index('user_id', 'user_id');
            $table->index('meal_name', 'meal_name');            
            $table->index('reservation_id', 'reservation_id');
            $table->index('added_on', 'added_on');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('host_id')->references('id')->on('users');
            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserved_meals');
    }
};
