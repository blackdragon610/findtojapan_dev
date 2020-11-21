<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * ユーザーアカウント
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時
            $table->rememberToken();

            $table->string("user_name")->comment("ユーザー名")->index();

            $table->string("email", 15)->comment("メールアドレス")->index();
            $table->string("password")->comment("パスワード");
            $table->string("tel", 20)->comment("電話番号")->index()->nullable(true);
            $table->string("image", 60)->comment("画像")->index()->nullable(true);
            $table->text("message")->comment("一言メッセージ")->nullable(true);
            $table->text("pr")->comment("PR")->nullable(true);

            $table->integer("is_push")->comment("プッシュ通知オンオフ")->default(0)->index();
            $table->integer("is_badge")->comment("バッジ通知オンオフ")->default(0)->index();
            $table->integer("is_email")->comment("メール通知オンオフ")->default(0)->index();

            $table->integer("count_like")->comment("")->default(0)->index();
            $table->integer("count_follower")->comment("")->default(0)->index();

            $table->integer("font")->comment("フォントの大きさ")->default(2)->index();
            $table->integer("point")->comment("ポイント")->default(0)->index();
            $table->integer("rank_id")->comment("ランクのID")->default(1)->index();

            $table->integer("category")->comment("カテゴリ")->default(0)->index();
            $table->integer("genre")->comment("ジャンル")->default(0)->index();
            $table->string("language", 20)->comment("言語")->default("ja")->index();



            $table->index(['email','password','deleted_at'], 'view_login')->comment("ログインのためのマルチカラムインデックス");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users");
    }
}
