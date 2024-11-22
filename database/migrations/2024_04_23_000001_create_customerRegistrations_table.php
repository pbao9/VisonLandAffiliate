<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('article_id');
            $table->text('referal_code')->nullable();
            $table->string('fullname', 255);
            $table->string('phone', 10);
            $table->integer('status')->default(0);
            $table->text('needs')->nullable();
            $table->double('amount_sold')->nullable();
            $table->dateTime('registration_day')->nullable();
            $table->dateTime('approval_day')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

        // module customerRegister
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Khách hàng đăng ký',
            'description' => '<p>Quản lý Khách hàng đăng ký</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Lakes
        DB::table('permissions')->insert([
            'title' => 'Xem KH Đăng ký',
            'name' => 'viewCustomerRegistrations',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm KH Đăng ký',
            'name' => 'createCustomerRegistrations',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa KH Đăng ký',
            'name' => 'updateCustomerRegistrations',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa KH Đăng ký',
            'name' => 'deleteCustomerRegistrations',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customerRegistrations');
    }
};
