<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {
use AuthenticatesUsers;


    /**
     * ログイン認証
     *
     * @var string
     */
    protected string $redirectTo = '/';
    protected string $redirectAfterLogout = '/login';


	public function index(Request $request)
    {

    }


    public function username()
    {

        return 'login_id';
    }


    protected function guard()
    {
        return \Auth::guard('user');
    }




}

