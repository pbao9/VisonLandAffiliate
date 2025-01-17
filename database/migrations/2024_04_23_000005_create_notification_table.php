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
        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('article_id')->nullable();
            // $table->unsignedBigInteger('customer_register_id')->nullable();
            // $table->unsignedBigInteger('customer_contact_id')->nullable();

            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('status')->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('set null');
            // $table->foreign('customer_register_id')->references('id')->on('customerregistrations')->onDelete('set null');
            // $table->foreign('customer_contact_id')->references('id')->on('customers')->onDelete('set null');
        });

        // module customerRegister
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Thông báo',
            'description' => '<p>Quản lý Thông báo</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Lakes
        DB::table('permissions')->insert([
            'title' => 'Xem Thông báo',
            'name' => 'viewNotification',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Thông báo',
            'name' => 'createNotification',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Thông báo',
            'name' => 'updateNotification',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Thông báo',
            'name' => 'deleteNotification',
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
        Schema::dropIfExists('notification');
    }
};
