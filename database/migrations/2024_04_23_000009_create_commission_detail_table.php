<?php

use App\Enums\CommissionDetail\CommissionDetailStatus;
use App\Enums\CommissionDetail\CommissionDetailType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_registration_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->bigInteger('total_amount');
            $table->bigInteger('paid_amount')->default(0);
            $table->bigInteger('remaining_amount')->default(0);
            $table->tinyInteger('status')->default(CommissionDetailStatus::Waiting);
            $table->tinyInteger('type')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
            $table->foreign('customer_registration_id')->references('id')->on('customer_registrations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_detail');
    }
};
