<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('导航名称');
            $table->string('route')->comment('导航路由');
            $table->tinyInteger('is_menu')->default(1)->comment('是否为主目录：1=》主目录[默认]；0=》非主目录');
            $table->tinyInteger('type_id')->default(0)->comment('父级目录ID，默认为0，即为主目录');
            $table->string('icon')->default('#xe620')->comment('ICON图标');
            $table->timestamps();

            $table->index(['type_id']);
        });

        //表注释
        DB::statement("ALTER TABLE `permissions` comment'管理员权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
