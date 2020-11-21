<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User  extends ModelClass implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;


    public $uploadType = "users";
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function saveEntry(array $data)
    {
        $Model = clone $this;
        $Model->user_name = $data["user_name"];
        $Model->email = $data["email"];
        $Model->password = bcrypt($data["password"]);
        $Model->save();
    }

    // 追加
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // 追加
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function categories()
    {
        return $this->hasMany(app("UserCategory"));
    }

    public function rank()
    {
        return $this->belongsTo(app("Rank"));
    }

}
