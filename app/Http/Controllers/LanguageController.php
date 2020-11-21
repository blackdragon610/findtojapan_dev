<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;


class LanguageController extends Controller
{

    /**
     * 言語状態取得
     * @param  string  $language
     * @param  ApiClass  $ApiClass
     * @param  Language  $Language
     * @return object
     */
    public function get(string $language, ApiClass $ApiClass, Language $Language)
    {
        $langueges = [];
        $results = $Language->whereLanguage($language)->get();

        foreach ($results as $result){
            $langueges[$result->from] = $result->body;
        }
        return $ApiClass->responseOk(["datas" => $langueges]);
    }



}
