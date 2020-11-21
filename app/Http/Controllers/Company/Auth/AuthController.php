<?php

namespace App\Http\Controllers\Company\Auth; // \Adminを追記

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller {
use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/company';
    protected $redirectAfterLogout = '/company';
		protected $username = 'login_id';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


		public function logout(Request $request)
    {
        $this->guard('company')->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/company');
    }

		public function username()
		{

		    return 'login_id';
		}


    protected function guard()
    {
        return \Auth::guard('company');
    }

		protected function credentials(Request $request)
    {
    	return array_merge($request->only($this->username(), 'password'));
    }


}

