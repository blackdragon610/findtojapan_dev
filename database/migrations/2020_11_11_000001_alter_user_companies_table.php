<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AlterUserCompaniesTable extends Migration
    {
        /**
         * チャットのメッセージ部分
         *
         * @return void
         */
        public function up()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->integer("type")->comment("アカウントの種類")->nullable(false)->default(1)->index();
                $table->string("login_id", 50)->comment("ログインID")->nullable(true)->default("")->index();
                $table->string("user_name_english", 255)->comment("英語表記")->nullable(true)->default("")->index();
                $table->text("address")->comment("住所")->nullable(true)->default("");
                $table->text("url")->comment("URL")->nullable(true)->default("");
                $table->string("time_open")->comment("営業時間(開始)")->nullable(true)->index();
                $table->string("time_close")->comment("営業時間(終了)")->nullable(true)->index();
                $table->string("holidays")->comment("定休日")->nullable(true)->index();
                $table->date("date_open")->comment("開催日")->nullable(true)->index();
                $table->text("gender")->comment("セクシャリティ")->nullable(true)->default("");
                $table->text("menu")->comment("メニュー")->nullable(true)->default("");
                $table->text("staff")->comment("スタッフ")->nullable(true)->default("");
                $table->text("twitter")->comment("Twitter")->nullable(true)->default("");
                $table->text("facebook")->comment("facebook")->nullable(true)->default("");
                $table->text("instagram")->comment("instagram")->nullable(true)->default("");
                $table->text("seats")->comment("席数")->nullable(true)->default("");
                $table->text("containment")->comment("収容人数")->nullable(true)->default("");
                $table->text("room")->comment("部屋数")->nullable(true)->default("");
                $table->text("private_room")->comment("個室数")->nullable(true)->default("");
                $table->text("options")->comment("オプション")->nullable(true)->default("");

                $table->string("image_add1", 80)->comment("追加画像1")->nullable(true)->default("");
                $table->string("image_add2", 80)->comment("追加画像2")->nullable(true)->default("");
                $table->string("image_add3", 80)->comment("追加画像3")->nullable(true)->default("");
                $table->string("image_add4", 80)->comment("追加画像4")->nullable(true)->default("");
                $table->string("image_add5", 80)->comment("追加画像5")->nullable(true)->default("");
                $table->string("image_add6", 80)->comment("追加画像6")->nullable(true)->default("");
                $table->string("image_add7", 80)->comment("追加画像7")->nullable(true)->default("");
                $table->string("image_add8", 80)->comment("追加画像8")->nullable(true)->default("");

                $table->string("movie", 80)->comment("動画")->nullable(true)->default("");


                /*
貸切の有無
Wi-Fi
充電
喫煙
                */


            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {

        }
    }
