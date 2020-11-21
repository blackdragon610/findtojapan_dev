<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefecturesTable extends Migration
{
    /**
     * ユーザーアカウント
     *
     * @return void
     */
    public function up()
    {
        Schema::create("prefectures", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時

            $table->integer("area_id")->comment("エリアのID");
            $table->string("prefecture_name")->comment("都道県名");


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
