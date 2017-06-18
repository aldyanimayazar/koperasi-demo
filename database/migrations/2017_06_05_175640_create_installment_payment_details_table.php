<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallmentPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('note')->nullable();
            $table->string('transaction_number');
            $table->integer('installment_payment_id')->unsigned();
            $table->foreign('installment_payment_id')->references('id')->on('installment_payments')->onDelete('cascade');
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
        Schema::dropIfExists('installment_payment_details');
    }
}
