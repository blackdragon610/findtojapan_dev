<?php

namespace App\Models;



class UserCategory extends ModelClass
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();
    }

    /**
     * ユーザーのカテゴリの保存
     * @param  int  $userIdFrom
     * @param  int  $userId
     * @return int
     */
    public function saveEntry(int $userId, $categories) : void
    {

        $user = $this->whereUserId($userId)->delete();

        foreach ($categories as $category){
            $UserCategory = clone $this;

            $UserCategory->user_id = $userId;
            $UserCategory->category_id = $category;
            $UserCategory->save();
        }

    }


    /**
     * 対象のユーザーとのいいねを取得
     * @param  int  $userId
     * @return mixed
     */
    public function getUser(int $userId)
    {
        $UserCategory = clone $this;

        $user = $UserCategory->whereUserId($userId);


        return $user;
    }


    public function category()
    {
        return $this->belongsTo(app("Category"));
    }
}
