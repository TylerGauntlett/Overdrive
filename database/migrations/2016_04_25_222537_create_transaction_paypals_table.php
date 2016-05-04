<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionPaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_paypals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('payer_id');
            $table->string('payment_id');
            $table->string('price');
            $table->string('product');
            $table->boolean('complete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_paypals');
    }
}
