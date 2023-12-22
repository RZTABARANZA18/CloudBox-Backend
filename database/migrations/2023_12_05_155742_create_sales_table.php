<?php

use App\Models\Product_model;
use App\Models\Transaction_model;
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

            // $table->foreign('prod_id')->references('prod_id')->on('product')->onDelete('cascade');;
            // $table->foreign('trans_id')->references('trans_id')->on('transactions');

            $table->timestamps();
        });

        Schema::table('sales', function (Blueprint $table) {
            // $table->foreignFor(Product_model::class, 'prod_id')->onDelete('cascade');
            // $table->foreignFor(Transaction_model::class, 'trans_id');

            $table->foreign('prod_id')->references('prod_id')->on((new Product_model())->getTable())->onDelete('cascade');
            $table->foreign('trans_id')->references('trans_id')->on((new Transaction_model())->getTable());
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
