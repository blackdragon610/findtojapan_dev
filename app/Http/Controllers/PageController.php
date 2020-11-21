<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\Page;
use App\Models\Qa;

class PageController extends Controller
{

    /**
     * ページ取得
     * @param string $type
     * @param ApiClass $ApiClass
     * @param Page $Page
     * @return object
     */
    public function get(string $type, ApiClass $ApiClass, Page $Page)
    {
        $areas = $Page->whereType($type)->first();

        return $ApiClass->responseOk(["datas" => $areas]);
    }

    /**
     * Q&Aの取得
     * @param  string  $question
     * @param  ApiClass  $ApiClass
     * @param  Qa  $Qa
     * @return object
     */
    public function question(string $question, ApiClass $ApiClass, Qa $Qa)
    {
        $questions = $Qa->whereType($question)->get();

        return $ApiClass->responseOk(["datas" => $questions]);
    }


}
