<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('transaction_number')->unique()->nullable();
            $table->enum('status', ['pending', 'open', 'reject', 'done'])->default('pending');
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('installment_payment', 12, 2)->default(0);

            $table->decimal('loan_amount', 12, 2)->change();
            $table->decimal('admin_fee', 12, 2)->change();
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
            $table->dropColumn(['transaction_number', 'status', 'total', 'installment_payment']);

            $table->float('loan_amount', 8, 2)->change();
            $table->float('admin_fee', 8, 2)->change();
        });
    }
}
