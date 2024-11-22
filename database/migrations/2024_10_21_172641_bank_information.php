<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bank_information', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name', 100);
            $table->char('bank_branch', 100);
            $table->string('bank_account',100);
            $table->char('bank_number', 100);
            $table->bigInteger('id_user')->unsigned(); 
            $table->foreign('id_user')->references('id')->on('users')->onDelete('Restrict');
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
        //
    }
};
