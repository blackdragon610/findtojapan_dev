<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Company\Controller;

class LoginController extends CompanyController {

    public function __construct()
    {

    }


    public function index()
    {

        return view('companies.login.index');

    }

}

?>
