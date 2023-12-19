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
        // trans_id. (PK) ==> int
        // trans_type ==> varchar
        // trans_date ==> date
        // income ==> double
        // description ==> varchar
        // update_balance ==> double
        // location ==> varchar
        // account_id(FK)

        Schema::create('transactions', function (Blueprint $table) {
            $table->id('trans_id');
            $table->string('trans_type');
            $table->decimal('income', 10, 2);
            $table->string('description');
            $table->decimal('update_balance', 10, 2);
            $table->string('location');
            $table->integer('account_id');

            $table->foreign('account_id')->references('account_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
