<?php

namespace App\Models;



class UserLike extends ModelClass
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
    public function saveEntry(int $userIdFrom, int $userId) : int
    {

        $user = $this->getUser($userIdFrom, $userId)->first();

        $count = 0;
        if (!$user){
            $UserLike = clone $this;

            $UserLike->user_id_from = $userIdFrom;
            $UserLike->user_id = $userId;
            $UserLike->save();

            $count = $this->reflash($userId);
        }

        return $count;
    }

    /**
     * いいねの削除
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return int
     */
    public function saveDestroy(int $userIdFrom, int $userId) : int
    {

        $user = $this->getUser($userIdFrom, $userId)->first();
        $user->delete();
        $count = $this->reflash($userId);

        return $count;
    }

    /**
     * 対象のユーザーとのいいねを取得
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return mixed
     */
    public function getUser(int $userIdFrom, int $userId)
    {
        $UserLike = clone $this;

        $user = $UserLike->whereUserIdFrom($userIdFrom)
            ->whereUserId($userId);


        return $user;
    }


    /**
     * 集計
     * @param  int  $userId
     * @return int
     */
    public function reflash(int $userId) : int
    {
        $UserLike = clone $this;
        $User = app("User");

        $count = $UserLike->whereUserId($userId)
            ->select(\DB::raw("COUNT(*) as total"))
            ->first();

        $result = 0;

        if ($count){
            $user = $User->find($userId);
            $result = $user->count_like = $count->total;
            $user->save();
        }

        return $result;
    }

}
