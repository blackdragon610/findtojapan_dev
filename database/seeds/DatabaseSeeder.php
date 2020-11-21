<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert([
            "admin_name" => "テスト",
            "login_id" => "admin",
            "email" => "makoto@tejima.jp",
            "password" => bcrypt("test"),
        ]);

        //ランク
        DB::table('ranks')->truncate();
        DB::table('ranks')->insert([
            "rank_name" => "レッドトロフィー",
            "point" => "0",
        ]);
        DB::table('ranks')->insert([
           "rank_name" => "オレンジトロフィー",
           "point" => "5000",
       ]);


        //エリア情報
        $area = file_get_contents(dirname(__FILE__) . "/area.txt");
        $areas = explode("\n", $area);


        DB::table('areas')->truncate();
        DB::table('prefectures')->truncate();
        DB::table('prefecture_areas')->truncate();
        DB::table('cities')->truncate();

        foreach ($areas as $area){
            if ($area){
                $data = explode("\t", trim($area));

                //地方
                if (!$areaDb = DB::table('areas')->where("area_name", $data[2])->first()){
                    $areaId = DB::table('areas')->insertGetId([
                        "area_name" => $data[2],
                    ]);
                }else{
                    $areaId = $areaDb->id;
                }

                //都道府県
                if (!$areaDb = DB::table('prefectures')->where("prefecture_name", $data[4])->first()){
                    $prefectureId = DB::table('prefectures')->insertGetId([
                        "area_id" => $areaId,
                      "prefecture_name" => $data[4],
                                                              ]);
                }else{
                    $prefectureId = $areaDb->id;
                }

                //エリア2
                if (!$areaDb = DB::table('prefecture_areas')->where("prefecture_id", $prefectureId)->where("area_name", $data[6])->first()){
                    $prefectureAreaId = DB::table('prefecture_areas')->insertGetId([
                                                                              "prefecture_id" => $prefectureId,
                                                                              "area_name" => $data[6],
                                                                          ]);
                }else{
                    $prefectureAreaId = $areaDb->id;
                }

                //市区町村
                $cities = explode("、", $data[9]);



                foreach ($cities as $city){
                    if (!$cityDb = DB::table('cities')->where("prefecture_area_id", $prefectureAreaId)->where("city_name", $city)->first()){
                        DB::table('cities')->insertGetId([
                                                                                 "prefecture_id" => $prefectureId,
                                                                                 "prefecture_area_id" => $prefectureAreaId,
                                                                                 "city_name" => $city,
                                                                             ]);
                    }
                }

            }
        }

        DB::table('categories')->truncate();
        DB::table('sub_categories')->truncate();

        //カテゴリ
        DB::table('categories')->insert([
            "category_name" => "エンターテインメント",
        ]);
        DB::table('categories')->insert([
            "category_name" => "買い物",
        ]);
        DB::table('categories')->insert([
            "category_name" => "交通",
        ]);



        DB::table('sub_categories')->insert([
            "category_id" => 1,
            "sub_name" => "ショー",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 1,
            "sub_name" => "その他",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 2,
            "sub_name" => "土産",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 2,
            "sub_name" => "グッズ",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 3,
            "sub_name" => "飛行機",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 3,
            "sub_name" => "電車",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 3,
            "sub_name" => "バス",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 3,
            "sub_name" => "タクシー",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 3,
            "sub_name" => "自動車",
        ]);
        DB::table('sub_categories')->insert([
            "category_id" => 3,
            "sub_name" => "レンタカー",
        ]);

    }
}
