<?php

namespace App\Models;


class UserPoint extends ModelClass
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function add(object $user, string $type)
    {
        $Model = clone $this;

        $points = configJson("point");

        $Model->user_id = $user->id;
        $Model->point = $points[$type];
        $Model->type = $points[$type];
        $Model->save();

        //ユーザーのポイントの更新
        $Model = clone $this;
        $total = $Model->whereUserId($user->id)
            ->select(\DB::raw("SUM(point) as total"))->first();

        $user->point = $total->total;

        $Rank = app("Rank");
        $rank = $Rank->whereNow($user->point)->first();

        $user->rank_id = $rank->id;
        $user->save();


    }

}
