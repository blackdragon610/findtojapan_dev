<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRepliesTable extends Migration
{
    /**
     * カテゴリ
     *
     * @return void
     */
    public function up()
    {
        Schema::create("post_replies", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->bigInteger("user_id")->comment("リプライ元のユーザーとの紐付け")->index();
            $table->bigInteger("post_id")->comment("リプライ先の記事との紐付け")->index();
            $table->text("comment")->comment("コメント");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("post_replies");
    }
}
