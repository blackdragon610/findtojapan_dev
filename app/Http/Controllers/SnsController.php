<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;


class SnsController extends Controller
{

    /**
     * ログイン
     * @param  string  $language
     * @param  ApiClass  $ApiClass
     * @param  Language  $Language
     * @return object
     */
    public function login(string $snsType)
    {
        echo "<script>alert('WW')</script>";
        exit();

    }



}
