<?php

namespace App\Models;


class Category extends ModelClass
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function subCategories()
    {
        return $this->hasMany(app("SubCategory"));
    }

}
