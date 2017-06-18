<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->integer('member_role_id')->unsigned();
            $table->foreign('member_role_id')->references('id')->on('member_roles')->onDelete('cascade');

            $table->string('name');
            $table->string('nik', 16)->unique();
            $table->string('email')->unique();
            $table->date('date_of_birth');
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->enum('blood_type', ['A', 'AB', 'B', 'O']);
            $table->enum('religion', ['islam', 'protestan', 'katolik', 'hindu', 'budha', 'kepercayaan']);
            $table->string('address');
            $table->string('phone');
            $table->integer('savings');
            $table->integer('salary');
            $table->decimal('max_plafond_debiting', 12, 2);
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
        Schema::drop('memberships');
    }

}
