<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\Area;
use App\Models\City;
use App\Models\Prefecture;
use App\Models\PrefectureArea;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    /**
     * エリア取得
     * @param  ApiClass  $ApiClass
     * @param  Area  $Area
     * @return object
     */
    public function area(ApiClass $ApiClass, Area $Area)
    {
        $areas = $Area->get();

        return $ApiClass->responseOk(["datas" => $areas]);
    }

    /**
     * 都道府県
     * @param  ApiClass  $ApiClass
     * @param  Prefecture  $Prefecture
     * @param  Request  $request
     * @return object
     */
    public function prefecture(ApiClass $ApiClass, Prefecture $Prefecture, Request $request)
    {
        if ($request->input("areaId")){
            $Prefecture = $Prefecture->where("area_id", $request->input("areaId"));
        }

        $prefectures = $Prefecture->get();

        return $ApiClass->responseOk(["datas" => $prefectures]);
    }

    /**
     * 都道府県のエリア
     * @param  ApiClass  $ApiClass
     * @param  PrefectureArea  $PrefectureArea
     * @param  Request  $request
     * @return object
     */
    public function prefectureArea(ApiClass $ApiClass, PrefectureArea $PrefectureArea, Request $request)
    {
        if ($request->input("prefectureId")){
            $PrefectureArea = $PrefectureArea->where("prefecture_id", $request->input("prefectureId"));
        }

        $prefectureAreas = $PrefectureArea->get();

        return $ApiClass->responseOk(["datas" => $prefectureAreas]);
    }

    public function city(ApiClass $ApiClass, City $City, Request $request)
    {
        if ($request->input("prefectureAreaId")){
            $City = $City->where("prefecture_area_id", $request->input("prefectureAreaId"));
        }

        $cities = $City->get();

        return $ApiClass->responseOk(["datas" => $cities]);
    }

}
