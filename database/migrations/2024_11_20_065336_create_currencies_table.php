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
        Schema::create('currencies', function (Blueprint $table) {            
            Schema::enableForeignKeyConstraints();
            $table->id();            
            $table->string('currency_code');
            $table->string('currency_name');
            $table->string('currency_country');
            $table->string('currency_symbol')->nullable();

            $table->index('currency_code', 'currency_code');
            $table->index('currency_name', 'currency_name');            
            $table->index('currency_country', 'currency_country');
            $table->index('currency_symbol', 'currency_symbol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
