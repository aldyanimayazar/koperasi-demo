<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('membership_id')->unsigned();
            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade');
            $table->float('loan_amount', 8, 2);
            $table->decimal('interest_by_year', 5, 2);
            $table->integer('tenor');
            $table->float('admin_fee', 8, 2);
            $table->text('note');
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
        Schema::dropIfExists('transactions');
    }
}
