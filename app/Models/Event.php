<?php

namespace App\Models;



use Illuminate\Support\Facades\Auth;

class Event extends ModelClass
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];


    /**
     * データ更新
     * @param  int  $userId
     * @param  array  $inputs
     * @return object
     */
    public function saveEntry(int $userId, array $inputs) : object
    {
        $Model = clone $this;

        if (!empty($inputs["id"])){
            $Model = $Model->whereId($inputs["id"])->whereUserId($userId)->first();

            if (!$Model){
                $Model = clone $this;
            }
        }

        $Model->setModel($inputs);

        $Model->user_id = $userId;
        $Model->date_limit .= " " . $inputs["time_limit"] . ":00";

        $Model->save();

        return $Model;
    }

    public function scopeWhereView($query)
    {
        $query->where("date_limit", ">", date("Y-m-d H:i:s"));
    }

    public function eventUserMy()
    {
        return $this->hasOne(app("EventUser"))->where("user_id", Auth::user()->id);
    }
    public function eventUser()
    {
        return $this->hasMany(app("EventUser"));
    }
    public function company()
    {
        return $this->belongsTo(app("Company"), "user_id", "id");
    }


}
