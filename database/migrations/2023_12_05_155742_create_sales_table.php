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

        Schema::create('sales', function (Blueprint $table) {
            $table->id('sales_id');
            // $table->integer('quantity');
            $table->decimal('quantity', 10, 2); //int to decimal
            $table->decimal('total_amount', 10, 2); //int to decimal
            $table->unsignedBigInteger('prod_id');
            $table->unsignedBigInteger('trans_id');

            $table->foreign('prod_id')->references('prod_id')->on('product');
            $table->foreign('trans_id')->references('trans_id')->on('transactions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
