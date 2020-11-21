<?php

namespace App\Models;



class UserToken extends ModelClass
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();
    }

}
