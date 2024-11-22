<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('supperAdmin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bank_account_number')->nullable();
            $table->string('transfer_syntax');
            $table->string('zalo_number');
            $table->string('hotline');
            $table->bigInteger('max_user_level');
            $table->bigInteger('commission_per_level');

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
        Schema::dropIfExists('supperAdmin_settings');
    }
};
