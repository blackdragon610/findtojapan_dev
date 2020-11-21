<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//フロント部分
Route::group(["middleware" => "common:user", "type" => "user"], function() {
    Route::group(["middleware" => "jwtCheck"], function () {
        Route::any("login/auth", "LoginController@auth");
        Route::any("login/logout", "LoginController@logout");

        //エリア関連
        Route::any("area/area", "AreaController@area");
        Route::any("area/prefecture", "AreaController@prefecture");
        Route::any("area/prefecture/area", "AreaController@prefectureArea");
        Route::any("area/city", "AreaController@city");

        //投稿関連
        Route::any("post/list", "PostController@list");
        Route::any("post/{userId}/user", "PostController@user");
        Route::any("post/save", "PostController@save");
        Route::any("post/now", "PostController@now");
        Route::any("post/map", "PostController@map");
        Route::any("post/{postId}/get", "PostController@get");

        //ハッシュとカテゴリ関連
        Route::any("categoryhash/category", "CategoryHashController@category");
        Route::any("categoryhash/category/sub", "CategoryHashController@subcategory");
        Route::any("categoryhash/category/group", "CategoryHashController@categoryGroup");
        Route::any("categoryhash/category/popular", "CategoryHashController@popularCategory");
        Route::any("categoryhash/hash/random", "CategoryHashController@hashRandom");
        Route::any("categoryhash/hash/search", "CategoryHashController@hashSearch");

        //ユーザー関連
        Route::any("user/change", "UserController@change");
        Route::any("user/{id}/get", "UserController@get");
        Route::any("user/email/check", "UserController@emailCheck");
        Route::any("user/count", "UserController@count");

        //いいね関連
        Route::any("like/user/{userId}/save", "LikeController@save");
        Route::any("like/user/{userId}/destroy", "LikeController@destroy");

        Route::any("like/post/{postId}/save", "LikeController@savePost");
        Route::any("like/post/{postId}/destroy", "LikeController@destroyPost");
        Route::any("reply/post/{postId}/save", "LikeController@saveReply");
        Route::any("reply/post/{postId}/destroy", "LikeController@destroyReply");

        //フォロワー関連
        Route::any("follower/user/{userId}/save", "FollowerController@save");
        Route::any("follower/user/{userId}/destroy", "FollowerController@destroy");

        //イベント関連
        Route::any("event/list", "EventController@list");
        Route::any("event/{eventId}/get", "EventController@detail");
        Route::any("event/{eventId}/join", "EventController@join");
        Route::any("event/{eventId}/unjoin", "EventController@unjoin");

        //ページ
        Route::any("page/{pageId}/get", "PageController@get");
        Route::any("page/{questionId}/question", "PageController@question");


    });

    //言語
    Route::any("language/{languageId}", "LanguageController@get");

    //画像関連
    Route::any("image", "ImageController@index");
    //ログイン関連
    Route::any("login", "LoginController@index");
    //登録
    Route::any("user/save", "UserController@save");

    //SNSログイン
    Route::any("sns/{snsType}", "SnsController@login");

});

