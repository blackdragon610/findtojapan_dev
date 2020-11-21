<?php

namespace App\Models;



class PostLike extends ModelClass
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();
    }

    /**
     * いいねの保存
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return int
     */
    public function saveEntry(int $userIdFrom, int $postId) : int
    {

        $user = $this->getPost($userIdFrom, $postId)->first();

        $count = 0;
        if (!$user){
            $UserLike = clone $this;

            $UserLike->user_id= $userIdFrom;
            $UserLike->post_id = $postId;
            $UserLike->save();

            $count = $this->reflash($postId);
        }

        return $count;
    }

    /**
     * いいねの削除
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return int
     */
    public function saveDestroy(int $userIdFrom, int $postId) : int
    {

        $post = $this->getPost($userIdFrom, $postId)->first();
        $count = 0;

        if ($post){
            $post->delete();
            $count = $this->reflash($postId);
        }

        return $count;
    }

    /**
     * 対象のユーザーとのいいねを取得
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return mixed
     */
    public function getPost(int $userIdFrom, int $postId)
    {
        $UserLike = clone $this;

        $user = $UserLike
            ->whereUserId($userIdFrom)
            ->wherePostId($postId);


        return $user;
    }


    /**
     * 集計
     * @param  int  $userId
     * @return int
     */
    public function reflash(int $postId) : int
    {
        $PostLike = clone $this;
        $Post = app("Post");

        $count = $PostLike
            ->wherePostId($postId)
            ->select(\DB::raw("COUNT(*) as total"))
            ->first();

        $result = 0;

        if ($count){
            $post = $Post->find($postId);
            $result = $post->count_like = $count->total;
            $post->save();
        }

        return $result;
    }

}
