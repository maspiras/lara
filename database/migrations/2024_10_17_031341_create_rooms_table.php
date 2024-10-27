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
        Schema::create('rooms', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->string('room_name');
            $table->integer('room_status_id')->nullable();
            $table->unsignedBigInteger('hosts_id');
           
            //$table->foreign('hosts_id')->references('id')->on('hosts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
           
            $table->index('hosts_id','hosts_id');
            $table->index('room_name','room_name');
            
            
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
