<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\Controller;
    use App\Models\Company;
    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
    use Illuminate\Support\Facades\View;


    class IndexController extends AdminController {
    use AuthenticatesUsers;

    public function __construct()
    {

    }


    public function index(Company $Company, Post $Post)
    {

        //店舗数
        $countCompany = $Company->count();

        //記事数
        $countPost = $Post->count();

        //ユーザー数
        $User = app("User");
        $countUser = $User->count();

        return view('admins.index',
        [
            "countCompany" => $countCompany,
            "countPost" => $countPost,
            "countUser" => $countUser,
        ]);

    }

}

?>
