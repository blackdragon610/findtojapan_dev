<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\PostLike;
use App\Models\PostReply;
use App\Models\UserLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    /**
     * ユーザーのいいねの追加
     * @param  int  $userId
     * @param  ApiClass  $ApiClass
     * @param  UserLike  $UserLike
     * @return object
     */
    public function save(int $userId, ApiClass $ApiClass, UserLike $UserLike)
    {
        $count = $UserLike->saveEntry(Auth::user()->id, $userId);

        return $ApiClass->responseOk(["count" => $count]);
    }

    /**
     * ユーザーのいいねの削除
     * @param  int  $userId
     * @param  ApiClass  $ApiClass
     * @param  UserLike  $UserLike
     * @return object
     */
    public function destroy(int $userId, ApiClass $ApiClass, UserLike $UserLike)
    {
        $count = $UserLike->saveDestroy(Auth::user()->id, $userId);

        return $ApiClass->responseOk(["count" => $count]);
    }

    /**
     * 投稿のいいねの追加
     * @param  int  $userId
     * @param  ApiClass  $ApiClass
     * @param  UserLike  $UserLike
     * @return object
     */
    public function savePost(int $postId, ApiClass $ApiClass, PostLike $PostLike)
    {

        $count = $PostLike->saveEntry(Auth::user()->id, $postId);

        return $ApiClass->responseOk(["count" => $count]);
    }

    /**
     * 投稿のいいねの削除
     * @param  int  $postId
     * @param  ApiClass  $ApiClass
     * @param  PostLike  $PostLike
     * @return object
     */
    public function destroyPost(int $postId, ApiClass $ApiClass, PostLike $PostLike)
    {
        $count = $PostLike->saveDestroy(Auth::user()->id, $postId);

        return $ApiClass->responseOk(["count" => $count]);
    }

    /**
     * 投稿のリプライの追加
     * @param  int  $postId
     * @param  ApiClass  $ApiClass
     * @param  PostReply  $PostReply
     * @param  Request  $request
     * @return object
     */
    public function saveReply(int $postId, ApiClass $ApiClass, PostReply $PostReply, Request $request)
    {

        $count = $PostReply->saveEntry(Auth::user()->id, $postId, $request->input("comment"));

        return $ApiClass->responseOk(["count" => $count]);
    }

    /**
     * 投稿のいいねの削除
     * @param  int  $postId
     * @param  ApiClass  $ApiClass
     * @param  PostLike  $PostLike
     * @return object
     */
    public function destroyReply(int $postId, ApiClass $ApiClass, PostReply $PostReply)
    {
        $count = $PostReply->saveDestroy(Auth::user()->id, $postId);

        return $ApiClass->responseOk(["count" => $count]);
    }
}
