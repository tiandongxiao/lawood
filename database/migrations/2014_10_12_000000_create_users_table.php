<?php

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
            $table->string('name',24)->nullable()->index();       # 用户名
            $table->string('nick_name',40)->nullable();           # 昵称
            $table->string('real_name',24)->nullable()->index();  # 真实姓名
            $table->string('phone',15)->unique()->nullable()->index();  # 手机号码
            $table->string('union_id')->unique()->nullable()->index();  # 微信 Union ID
            $table->string('open_id')->unique()->nullable()->index();   # 微信 Open ID
            $table->string('union_id')->unique()->nullable()->index();  # 微信 Union ID
            $table->string('wb_id')->unique()->nullable()->index();     # 新浪微博 ID
            $table->string('email',40)->unique()->nullable()->index();  # 邮箱
            $table->boolean('email_active')->default(false);  # 邮箱是否激活
            $table->string('role',20)->nullable();            # 用户角色类型
            $table->string('avatar')->nullable();             # 用户头像
            $table->boolean('active')->default(false);        # 用户是否已激活
            $table->string('password', 60)->nullable();       # 密码
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
        Schema::drop('users');
    }
}
