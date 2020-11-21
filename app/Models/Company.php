<?php

namespace App\Models;



use App\Scopes\CompanyScope;

class Company extends User
{
    public $table = "users";
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
    public $uploadType = "companies";

    protected static function boot(){
        parent::boot();

        static::addGlobalScope(new CompanyScope);

    }

    public function saveEntry(array $inputs) : object
    {
        $Model = clone $this;

        if (!empty($inputs["id"])){
            $Model = $Model->whereId($inputs["id"])->first();
        }

        $Model->setModel($inputs);

        $UploadClass = app('UploadClass');

        if ($inputs["image"]){
            $UploadClass->setStorage($inputs["image"], $this->uploadType);
        }

        for ($i = 1; $i <= 8; $i++){
            if (!empty($inputs["image_add" . $i])){
                $UploadClass->setStorage($inputs["image_add" . $i], $this->uploadType);
            }
        }

        if (!empty($inputs["movie"])){
            $Model->movie = $inputs["movie"];
        }

        if ($inputs["password"]){
            $Model->changePassword();
        }

        $Model->type = 2;
        $Model->save();



        return $Model;
    }

}
