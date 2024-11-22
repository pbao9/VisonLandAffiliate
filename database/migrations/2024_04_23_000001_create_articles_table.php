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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('admin_id')->nullable();
            $table->string('code')->nullable();
            $table->integer('type')->nullable();
            $table->string('title');
            $table->text('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('area')->nullable();
            $table->string('price_level')->nullable();
            $table->boolean('price_consent')->nullable();
            $table->integer('quantity');
            $table->bigInteger('height_floor')->nullable();
            $table->bigInteger('project_size');
            $table->string('investor')->nullable();
            $table->string('constructor')->nullable();
            $table->string('operative_management')->nullable();
            $table->string('hand_over')->nullable();
            $table->dateTime('deployment_time')->nullable();
            $table->bigInteger('building_density')->nullable();
            $table->text('utilities')->nullable();
            $table->longText('image');
            $table->string('name_contact')->nullable();
            $table->string('phone_contact');
            $table->integer('status')->default(1);
            $table->integer('active_days')->nullable();
            $table->double('price_post_type')->nullable();
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_end')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->bigInteger('ward_id')->nullable();
            $table->bigInteger('province_id')->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('article_status')->default(1);
            $table->bigInteger('commission_id');
            $table->integer('houseType_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('active_status')->default(1);
            $table->timestamps();
        });


        // module customerRegister
        $module_id = DB::table('modules')->insertGetId([
            'name' => 'Quản lý Bài đăng',
            'description' => '<p>Quản lý Bài đăng</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        // Permission của module Lakes
        DB::table('permissions')->insert([
            'title' => 'Xem Bài đăng',
            'name' => 'viewArticles',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Thêm Bài đăng',
            'name' => 'createArticles',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Sửa Bài đăng',
            'name' => 'updateArticles',
            'guard_name' => 'admin',
            'module_id' => $module_id,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'title' => 'Xóa Bài đăng',
            'name' => 'deleteArticles',
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
        Schema::dropIfExists('articles');
    }
};
