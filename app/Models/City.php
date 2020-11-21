<?php

namespace App\Models;



class City extends ModelClass
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function getAddress() : string
    {

        $Prefecture = app("Prefecture");
        $prefecture = $Prefecture->find($this->prefecture_id);


        $address = $prefecture->prefecture_name . $this->city_name;

        return $address;
    }

    public function getFullId(string $address) : array
    {
        $Model = clone $this;

        $result = [];

        $data = $Model
            ->leftJoin("prefectures", "prefectures.id", "=", "cities.prefecture_id")
            ->whereRaw("'" . $address . "' LIKE concat('%',concat(prefecture_name, city_name),'%')")
            ->select(\DB::raw("*,cities.id as id"))
            ->first()
        ;

        if ($data){
            $result["area_id"] = $data->area_id;
            $result["prefecture_id"] = $data->prefecture_id;
            $result["prefecture_area_id"] = $data->prefecture_area_id;
            $result["city_id"] = $data->id;

        }

        return $result;
    }

}
