<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;


class CompanyController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function common($redirect=true, $type=0){
        parent::common();
    }

    public function search($db){
        return $db;
    }



}
