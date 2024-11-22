<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('code', 50)->unique();
            $table->string('fullname');
            $table->char('email', 100)->unique();
            $table->char('phone', 20)->unique();
            $table->text('address')->nullable();
            $table->text('avatar')->nullable();
            $table->tinyInteger('gender');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token_get_password')->nullable();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->integer('identifier')->default(0);
            $table->string('cccd_front_image', 200)->nullable();
            $table->string('cccd_back_image', 200)->nullable();
            $table->string('cccd_number', 20)->nullable();
            $table->string('issued_by', 100)->nullable();
            $table->date('issued_day')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('device_token')->nullable();
            $table->tinyInteger('roles');
            $table->integer('parent_id')->nullable();
            $table->string('otp', 5)->nullable();
            $table->dateTime('CreatedOtp')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
