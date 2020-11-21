<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin  extends ModelClass
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function saveEntry(array $inputs)
    {
        $Model = clone $this;

        if (!empty($inputs["id"])){
            $Model = $Model->whereId($inputs["id"])->first();
        }

        $Model->setModel($inputs);


        if ($inputs["password"]){
            $Model->changePassword();
        }




        $Model->save();

    }


}
