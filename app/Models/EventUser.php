<?php

namespace App\Models;



class EventUser extends ModelClass
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function scopeWhereView($query)
    {
        $query->where("date_limit", ">", date("Y-m-d H:i:s"));
    }

    /**
     * イベント参加の保存
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return int
     */
    public function saveEntry(int $eventId, int $userId) : int
    {

        $user = $this->getUser($eventId, $userId)->first();

        $count = 0;
        if (!$user){
            $EventUser = clone $this;

            $EventUser->event_id = $eventId;
            $EventUser->user_id = $userId;
            $EventUser->save();

            //$count = $this->reflash($userId);
        }

        return $count;
    }

    /**
     * イベントの削除
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return int
     */
    public function saveDestroy(int $eventId, int $userId) : void
    {

        $user = $this->getUser($eventId, $userId)->first();
        $user->delete();

    }

    /**
     * 対象のユーザーとのフォロワーを取得
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return mixed
     */
    public function getUser(int $eventId, int $userId)
    {
        $EventUser = clone $this;

        $user = $EventUser->whereEventId($eventId)
            ->whereUserId($userId);


        return $user;
    }

    public function user()
    {
        return $this->belongsTo(app("User"));
    }

}
