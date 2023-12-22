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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id("act_id");
            $table->string('type');
            $table->integer('prod_id');
            $table->integer('account_id');

            // $table->foreign('prod_id')->references('prod_id')->on('product')->onDelete('cascade');;
            // $table->foreign('account_id')->references('account_id')->on('users');

            $table->timestamps();
        });

        Schema::table('activity_log', function (Blueprint $table) {
            // Foreign key constraint for 'prod_id' referencing 'prod_id' in 'product_model' table
            // $table->foreign('prod_id')->references('prod_id')->on((new Product_model())->getTable())->onDelete('cascade');
            $table->foreign('prod_id', 'product_id')->references('prod_id')->on((new Product_model())->getTable())->onDelete('cascade');

            // Foreign key constraint for 'account_id' referencing 'account_id' in 'users' table
            $table->foreign('account_id')->references('account_id')->on((new User())->getTable());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
