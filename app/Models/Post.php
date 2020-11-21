<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Post extends ModelClass
{
    use SoftDeletes;

    public $uploadType = "users";
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];


    /**
     * @param  array  $data
     */
    public function saveEntry(int $userId, array $datas)
    {

        $Model = clone $this;

        $Model->setTransaction("投稿中にエラーがありました。", function() use($datas, $userId){
            foreach ($datas as $key => $data){
                if (!is_array($datas[$key])){
                    $this->$key = $datas[$key];
                }
            }

            $this->user_id = $userId;


            //緯度経度
            $GeometryClass = app("GeometryClass");
            $geo = $GeometryClass->fromAddress($this->point);

            if (isset($geo["results"][0]["geometry"]["location"])){
                $this->latlng = \DB::raw("(ST_GeomFromText('POINT(" . $geo["results"][0]["geometry"]["location"]["lat"]. " " . $geo["results"][0]["geometry"]["location"]["lng"] . ")'))");
            }

            //住所
            if (isset($geo["results"][0]["geometry"]["location"]["lat"])){
                $this->address = $GeometryClass->fromLatlng($geo["results"][0]["geometry"]["location"]["lat"], $geo["results"][0]["geometry"]["location"]["lng"]);

                $City = app("City");
                $areas = $City->getFullId($this->address);

                $this->area_id = $areas["area_id"];
                $this->prefecture_id = $areas["prefecture_id"];
                $this->prefecture_area_id = $areas["prefecture_area_id"];
                $this->city_id = $areas["city_id"];
            }


            $this->save();



            //画像保存
            if (!empty($datas["images"])){
                foreach ($datas["images"] as $image) {
                    $UploadClass = app("UploadClass");
                    $PostImage = app("PostImage");

                    $PostImage->post_id = $this->id;
                    $PostImage->image = md5(uniqid(rand(), 1));

                    $UploadClass->setStorageBinary($PostImage->image, "posts", base64_decode($image));
                    $PostImage->save();
                }
            }

            $PostHash = app("PostHash");
            $PostHash->wherePostId($this->id)->delete();

            if (isset($datas["hashes"])){
                foreach ($datas["hashes"] as $hash){
                    if ($hash){
                        $PostHash = app("PostHash");
                        $PostHash->post_id = $this->id;
                        $PostHash->hash_name = $hash;
                        $PostHash->save();

                        /*$Hash = app("Hash");
                        $Hash = $Hash->where("hash_name", $hash)->first();
                        if (!$Hash){
                            $Hash = app("Hash");
                        }

                        $Hash->hash_name = $hash;
                        $Hash->count++;
                        $Hash->save();*/

                    }
                }
            }
            if (isset($datas["categories"])){
                foreach ($datas["categories"] as $category){

                    if ($category){
                        $PostCategory = app("PostCategory");
                        $PostCategory->post_id = $this->id;
                        $PostCategory->sub_category_id = $category;
                        $PostCategory->save();
                    }
                }
            }
        });
    }

    public function saveEntryAdmin(int $userId, array $inputs)
    {
        $Model = clone $this;

        if (!empty($inputs["id"])) {
            $Model = $Model->whereId($inputs["id"])->first();
        }

        $Model->setModel($inputs);

        //緯度経度
        $GeometryClass = app("GeometryClass");
        $geo = $GeometryClass->fromAddress($Model->point);

        if (isset($geo["results"][0]["geometry"]["location"])){
            $Model->latlng = \DB::raw("(ST_GeomFromText('POINT(" . $geo["results"][0]["geometry"]["location"]["lat"]. " " . $geo["results"][0]["geometry"]["location"]["lng"] . ")'))");
        }

        //住所
        if (isset($geo["results"][0]["geometry"]["location"]["lat"])){
            $Model->address = $GeometryClass->fromLatlng($geo["results"][0]["geometry"]["location"]["lat"], $geo["results"][0]["geometry"]["location"]["lng"]);

            $City = app("City");
            $areas = $City->getFullId($Model->address);

            $Model->area_id = $areas["area_id"];
            $Model->prefecture_id = $areas["prefecture_id"];
            $Model->prefecture_area_id = $areas["prefecture_area_id"];
            $Model->city_id = $areas["city_id"];
        }

        $Model->save();
    }

    /**
     * データ更新
     * @param  int  $userId
     * @param  array  $inputs
     * @return object
     */
    public function saveEntryCompany(int $userId, array $inputs) : object
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
        $Model->save();

        return $Model;
    }

    public function scopeLatlng($query)
    {
        $query->select(\DB::raw('posts.id as id,user_id,type,date,point,body,evaluation,count_like,count_follower,count_reply,X(latlng) as lat,Y(latlng) as lng'));
    }

    public function hashes()
    {
        return $this->hasMany(app("PostHash"));
    }

    public function categories()
    {
        return $this->hasMany(app("PostCategory"));
    }

    public function imageOne()
    {
        return $this->hasOne(app("PostImage"))->orderBy("id", "ASC");
    }
    public function images()
    {
        return $this->hasMany(app("PostImage"));
    }

    public function user()
    {
        return $this->belongsTo(app("User"));
    }
}
