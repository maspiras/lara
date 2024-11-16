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
        Schema::create('services', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('host_id');
            $table->unsignedBigInteger('user_id');
            $table->string('service_name');
            $table->string('service_desc')->nullable();
            $table->tinyInteger('period');
            $table->tinyInteger('payment');
            $table->decimal('amount', 9, 2);
            $table->timestamp('added_on');

            $table->index('host_id', 'host_id');
            $table->index('user_id', 'user_id');
            $table->index('service_name', 'service_name');            
            $table->index('period', 'period');
            $table->index('added_on', 'added_on');

            $table->foreign('user_id')->references('id')->on('users');            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
