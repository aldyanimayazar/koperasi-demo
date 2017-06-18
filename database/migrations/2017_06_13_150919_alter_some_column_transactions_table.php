<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSomeColumnTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('interest_by_year', 'interest');
            $table->renameColumn('loan_amount', 'amount');
            $table->string('interest_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->renameColumn('interest', 'interest_by_year');
            $table->renameColumn('amount', 'loan_amount');
            $table->dropColumn('interest_by');
        });
    }
}
