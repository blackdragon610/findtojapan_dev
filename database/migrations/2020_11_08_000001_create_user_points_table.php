<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPointsTable extends Migration
{
    /**
     * カテゴリ
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_points", function (Blueprint $table) {
            $table->bigIncrements("id");        //ID
            $table->timestamps();                       //作成日時、更新日時
            $table->softDeletes();                      //削除日時

            $table->bigInteger("user_id")->comment("ポイントの対象のID")->index();
            $table->integer("point")->comment("ポイント")->index();
            $table->string("type", 50)->comment("ポイントの種類")->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_points");
    }
}
