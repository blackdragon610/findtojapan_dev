<?php

namespace App\Models;


class Rank extends ModelClass
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * 次のランク
     * @param  int  $point
     */
    public function scopeWhereFuture($query, int $point)
    {
        $query->where("point", ">", $point)->orderBy("point", "ASC");
    }
    /**
     * 今のランク
     * @param  int  $point
     */
    public function scopeWhereNow($query, int $point)
    {
        $query->where("point", "<=", $point)->orderBy("point", "DESC");
    }
}
