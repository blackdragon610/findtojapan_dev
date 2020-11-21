<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCategoriesTable extends Migration
{
    /**
     * ユーザーアカウント
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_categories", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->bigInteger("user_id")->comment("ユーザーのID")->index();
            $table->integer("category_id")->comment("カテゴリ")->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("post_categories");
    }
}
