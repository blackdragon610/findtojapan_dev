<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\Controller;
use App\Libs\PushClass;
use Google\Cloud\Translate\TranslateClient;


class LoginController extends AdminController {

    public function __construct()
    {

    }


    public function index()
    {
        /*
        $Language = app("Language");
        $Language->adds();
        */

         return view('admins.login.index');


    }

}

?>
