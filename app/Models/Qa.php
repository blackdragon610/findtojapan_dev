<?php

namespace App\Models;


class Qa extends ModelClass
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function saveEntry(array $inputs) : object
    {
        $Model = clone $this;

        if (!empty($inputs["id"])) {
            $Model = $Model->whereId($inputs["id"])->first();
        }

        $Model->setModel($inputs);

        $Model->save();

        return $Model;
    }
}
