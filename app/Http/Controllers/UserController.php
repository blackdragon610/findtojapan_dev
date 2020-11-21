<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Libs\UploadClass;
use App\Models\Post;
use App\Models\PostReply;
use App\Models\Rank;
use App\Models\User;
use App\Models\UserCategory;
use App\Models\UserFollower;
use App\Models\UserLike;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * データ取得
     * @param  int  $userId
     * @param  ApiClass  $ApiClass
     * @param  User  $User
     * @param  UserLike  $UserLike
     * @param  UserFollower  $UserFollower
     * @return object
     */
    public function get(int $userId, ApiClass $ApiClass, User $User, UserLike $UserLike, UserFollower $UserFollower)
    {
        $user = $User->find($userId);

        //その人にいいねしたか？
        $userLike = $UserLike->getUser(Auth::user()->id, $userId)->first();

        $user->isLike = false;
        if ($userLike){
            $user->isLike = true;
        }

        //その人のフォローしたか？
        $userFollower = $UserFollower->getUser(Auth::user()->id, $userId)->first();

        $user->isFollower = false;
        if ($userFollower){
            $user->isFollower = true;
        }

        $user->categories = $user->categories;

        if ($user->categories){
            foreach ($user->categories as $key => $category){
                $user->categories[$key]["category"] = $category->category;
            }
        }

        if ($user->options){
            $user->options = json_decode($user->options);
        }
        if ($user->holidays){
            $user->holidays = json_decode($user->holidays);
        }

        return $ApiClass->responseOk([
            "data" => $user
        ]);
    }

    /**
     * ユーザー関連
     *
     * @param  ApiClass  $ApiClass
     * @param  User  $User
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function save(ApiClass $ApiClass, User $User, Request $request)
    {

        $data = $request->input("data");

        //メールアドレスが同一のものがある場合はエラー
        if ($User->whereEmail($data["email"])->first()){
            return $ApiClass->responseError("メールアドレスが既に登録済みです");
        }
        $User->saveEntry($data);

        return $ApiClass->responseOk();
    }

    /**
     * ユーザー情報変更
     * @param  ApiClass  $ApiClass
     * @param  User  $User
     * @param  Request  $request
     * @param  UploadClass  $UploadClass
     * @param  UserCategory  $UserCategory
     */
    public function change(ApiClass $ApiClass, User $User, Request $request, UploadClass $UploadClass, UserCategory $UserCategory)
    {
        $user = $User->find(Auth::user()->id);

        $datas = $request->input("data");
        $categories = [];

        foreach ($datas as $key => $data){
            $user->$key = $data;

            if ($key == "categories"){
                $categories = $data;
                unset($user->$key);
            }

            if ($key == "image")
            {
                if ($data){
                    $UploadClass->setStorageBinary(Auth::user()->id . "_" . $key,"users", base64_decode($data));
                    $user->$key = Auth::user()->id . "_" . $key;
                }

            }
            if ($key == "password")
            {
                $user->$key = bcrypt($user->$key);
            }
        }

        //カテゴリの変更があれば対応
        if ($categories){
            $UserCategory->saveEntry(Auth::user()->id, $categories);
        }

        $user->save();

        return $ApiClass->responseOk();
    }

    /**
     * メールアドレスチェック
     * @param  ApiClass  $ApiClass
     * @param  Request  $request
     * @param  User  $User
     * @return object
     */
    public function emailCheck(ApiClass $ApiClass, Request $request, User $User)
    {
        if (Auth::user()->email == $request->input("email")){
            //自分自身はOK
            return $ApiClass->responseOk();
        }

        //他のメールアドレスで同一のものがある場合はNG
        if ($User->whereEmail($request->input("email"))->first()){
            return $ApiClass->responseError("重複したメールアドレスがあります");
        }

        return $ApiClass->responseOk();
    }

    public function count(ApiClass $ApiClass, Request $request, User $User, Post $Post, PostReply $PostReply, Rank $Rank)
    {

        $user = \Auth::user();

        //ポイントとトロフィー
        $users["point"] = $user->point;

        $users["rank"] = $Rank->find($user->rank_id);
        $rank = $Rank->whereFuture($user->point)->first();
        $users["rankFuture"] = $rank;


        //数のカウント
        $users["postGo"] = $Post->whereType(1)->count();
        $users["postGoing"] = $Post->whereType(2)->count();
        $users["postReview"] = $Post->whereType(3)->count();
        $users["like"] = $user->count_like;
        $users["follower"] = $user->count_follower;
        $users["reply"] = $PostReply
            ->leftJoin("posts", "posts.id", "=", "post_replies.post_id")
            ->where("posts.user_id", $user->id)->count();

        return $ApiClass->responseOk(["data" => $users]);
    }
}
