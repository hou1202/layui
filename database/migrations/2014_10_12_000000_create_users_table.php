<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->unique()->comment('登录帐户');
            $table->string('password')->comment('密码');
            $table->string('name')->comment('真实姓名');
            $table->string('phone')->comment('手机号码');
            $table->string('portrait')->default('/home/images/portrait.png')->comment('头像');
            $table->date('birthday')->default('2000-01-01')->comment('生日');
            $table->tinyInteger('sex')->default('1')->comment('性别：0=》女；1=》男');
            $table->string('position')->comment('岗位');
            $table->date('join')->comment('入职时间');
            $table->integer('departments_id')->default(0)->comment('部门,即权限组');
            $table->integer('salaries_id')->default(0)->comment('薪资ID');
            $table->tinyInteger('status')->default(1)->comment('帐户状态：1=》正常；0=》禁用');
            $table->text('remarks')->comment('备注');
            $table->rememberToken();
            $table->timestamps();

            $table->index(['account','phone','departments_id','birthday']);
        });

        //表注释
        DB::statement("ALTER TABLE `users` comment'用户表'");


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
}
