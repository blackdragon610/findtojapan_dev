<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Libs\PushClass;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /**
     * ログイン
     *
     * @param  ApiClass  $ApiClass
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ApiClass $ApiClass)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $ApiClass->responseError("ログインができませんでした");
        }

        return $ApiClass->responseOk(["token" => $token]);
    }

    /**
     * 認証処理
     * @param  ApiClass  $ApiClass
     * @param  UserCategory  $UserCategory
     * @return object
     */
    public function auth(ApiClass $ApiClass, UserCategory $UserCategory)
    {
        $user = auth()->user();
        $user->categories = $UserCategory->getUser($user->id)->get();

        return $ApiClass->responseOk(["user" => $user]);
    }

    public function logout(ApiClass $ApiClass, Request $request)
    {
        //$PushClass->deleteToken($request->input("deviceToken"));

        auth()->logout();

        return $ApiClass->responseOk([]);

    }

    /**
     * トークン関連
     * @param  ApiClass  $ApiClass
     * @param  PushClass  $PushClass
     * @param  Request  $request
     * @return object
     */
    public function token(ApiClass $ApiClass, PushClass $PushClass, Request $request)
    {
        $PushClass->setToken($request->input("deviceToken"), $request->input("token"), $request->input("os"));


        return $ApiClass->responseOk([]);
    }
}
