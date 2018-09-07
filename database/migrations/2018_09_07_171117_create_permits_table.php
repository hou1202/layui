<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('departments_id')->comment('部门ID，即权限组ID');
            $table->integer('routes_id')->comment('路由ID');
            $table->timestamps();

            $table->index(['departments_id','routes_id']);
        });

        //表注释
        DB::statement("ALTER TABLE `permits` comment'用户权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permits');
    }
}
