<?php

use App\Models\Product_model;
use App\Models\User;
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
        Schema::create('stock', function (Blueprint $table) {
            $table->id('stock_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('prod_id');
            $table->unsignedBigInteger('account_id'); // Changed foreign key name
            $table->timestamps();


            // $table->foreign('prod_id')->references('prod_id')->on('product')->onDelete('cascade');; // Adjusted foreign key references
            // $table->foreign('account_id')->references('account_id')->on('users'); // Corrected reference to 'users' table
        });

        Schema::table('stock', function (Blueprint $table) {
            $table->foreign('prod_id')->references('prod_id')->on((new Product_model())->getTable())->onDelete('cascade');
            $table->foreign('account_id')->references('account_id')->on((new User())->getTable());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
