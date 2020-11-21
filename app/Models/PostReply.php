<?php

namespace App\Models;



class PostReply extends ModelClass
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
     * @param  int  $postId
     * @param  string  $comment
     * @return int
     */
    public function saveEntry(int $userIdFrom, int $postId, ?string $comment) : int
    {

        $user = $this->getPost($userIdFrom, $postId)->first();

        $count = 0;
        if (!$user){
            $PostReply = clone $this;

            $PostReply->user_id= $userIdFrom;
            $PostReply->post_id = $postId;
            $PostReply->comment = $comment;
            $PostReply->save();

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
        $PostReply = clone $this;

        $user = $PostReply
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
            $result = $post->count_reply = $count->total;
            $post->save();
        }

        return $result;
    }

}
