<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Company\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



    class IndexController extends CompanyController {
    use AuthenticatesUsers;

    public function __construct()
    {

    }


    public function index()
    {


        return view('companies.index');

    }

}

?>
