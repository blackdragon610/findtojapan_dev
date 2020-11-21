<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * カテゴリ
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pages", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->string("type", 50)->comment("種類")->index();
            $table->string("page_name")->comment("タイトル")->index();
            $table->longText("body")->comment("内容");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("pages");
    }
}
