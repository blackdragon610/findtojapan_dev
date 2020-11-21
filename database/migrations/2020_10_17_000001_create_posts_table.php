<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * ユーザーアカウント
     *
     * @return void
     */
    public function up()
    {
        Schema::create("posts", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->bigInteger("user_id")->comment("ユーザーのID")->index();

            $table->integer("type")->comment("種類");
            $table->date("date")->comment("日付")->index()->nullable(true);
            $table->string("point")->comment("どこにいきましたか？")->nullable(true);
            $table->text("body")->comment("どうでしたか？")->nullable(true);
            $table->integer("evaluation")->comment("評価")->nullable(true);

            $table->integer("count_like")->comment("いいね");
            $table->integer("count_follower")->comment("フォロワー数");
            $table->integer("count_reply")->comment("リプライ");

            $table->geometry('latlng')->comment("緯度経度")->nullable(true);
            $table->text('address')->comment("住所")->nullable(true);


            $table->integer("area_id")->comment("エリアのID");
            $table->integer("prefecture_id")->comment("都道府県のID");
            $table->integer("prefecture_area_id")->comment("都道府県のエリアのID");
            $table->integer("city_id")->comment("市区のID");



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("posts");
    }
}
