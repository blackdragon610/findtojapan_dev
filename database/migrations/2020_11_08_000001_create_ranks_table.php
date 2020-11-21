<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRanksTable extends Migration
{
    /**
     * トロフィー
     *
     * @return void
     */
    public function up()
    {
        Schema::create("ranks", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->string("rank_name")->comment("トロフィーの名前")->index();
            $table->integer("point")->comment("ポイント")->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_ranks");
    }
}
