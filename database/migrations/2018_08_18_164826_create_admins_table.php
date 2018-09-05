<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('admins')){
            Schema::create('admins', function (Blueprint $table) {
                $table->increments('id')-> comment('ID');
                $table->string('account') -> comment('登录帐号');
                $table->string('password') -> comment('登录密码');
                $table->string('name') -> comment('真实姓名');
                $table->tinyInteger('status') ->nullable(true) -> comment('帐户状态');
                $table->tinyInteger('role_id') ->default(0) -> comment('权限组');
                $table->tinyInteger('is_super') ->default(0) -> comment('是否是超级管理员');
                $table->ipAddress('last_ip') -> nullable(true) -> comment('最后登录IP地址');
                $table->dateTime('last_at') -> nullable(true) -> comment('最后登录时间');
                $table->integer('log_count') ->default(0) -> comment('登录总次数');
                $table->text('remarks') -> nullable(true) -> commemt('备注');
                $table->string('remember_token') ->nullable(true)-> comment('保持登录TOKEN');
                $table->timestamps();
            });
        }else{
            Schema::table('admins',function(Blueprint $table) {

            });
        }

        //表注释
        DB::statement("ALTER TABLE `admins` comment'管理员表'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('managers');
    }
}
