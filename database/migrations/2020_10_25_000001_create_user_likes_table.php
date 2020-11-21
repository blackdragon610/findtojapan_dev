<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLikesTable extends Migration
{
    /**
     * カテゴリ
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_likes", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->bigInteger("user_id_from")->comment("いいね元のユーザーとの紐付け")->index();
            $table->bigInteger("user_id")->comment("いいね先のユーザーとの紐付け")->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_likes");
    }
}
