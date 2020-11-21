<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * 管理画面
     *
     * @return void
     */
    public function up()
    {
        Schema::create("admins", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->string('admin_name')->comment('管理者名')->index();
            $table->string('login_id',15)->comment('ログインID')->index()->nullable();
            $table->string('email')->comment('メールアドレス')->index();
            $table->string('password')->comment('パスワード	')->index();


            $table->index(['email','password','deleted_at'], 'login_key');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_images");
    }
}
