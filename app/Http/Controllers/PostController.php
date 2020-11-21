<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Libs\PostClass;
use App\Models\Area;
use App\Models\City;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostReply;
use App\Models\Prefecture;
use App\Models\PrefectureArea;
use App\Models\UserFollower;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * 全項目の取得
     * @param  ApiClass  $ApiClass
     * @param  Post  $Post
     * @param  Request  $request
     * @param  Area  $Area
     * @param  Prefecture  $Prefecture
     * @param  PrefectureArea  $PrefectureArea
     * @param  City  $City
     * @return object
     */
    public function list(ApiClass $ApiClass, Post $Post, Request $request, Area $Area, Prefecture $Prefecture, PrefectureArea $PrefectureArea, City $City)
    {
        $posts = $Post;

        //キーワード検索
        if ($request->input("keyword")){
            $posts = $posts
                ->where(function($query) use($request){
                    $query->orWhere("body", "LIKE", "%" . $request->input("keyword") . "%");
                    $query->orWhere("point", "LIKE", "%" . $request->input("keyword") . "%");
                });
        }

        //日付検索
        if ($request->input("dateStart")){
            $posts = $posts->where("date", ">=", $request->input("dateStart"));
        }
        if ($request->input("dateEnd")){
            $posts = $posts->where("date", "<=", $request->input("dateEnd"));
        }

        //カテゴリ検索
        if ($request->input("subCategoryId")){
            $posts = $posts->leftJoin("post_categories", "post_categories.post_id", "=", "posts.id");
            $posts = $posts->where("sub_category_id", $request->input("subCategoryId"));
        }

        //ハッシュ検索
        if ($request->input("hashName")){
            $posts = $posts
                ->leftJoin("post_hashes", "post_hashes.post_id", "=", "posts.id")
                ->where("hash_name", "LIKE", "%" . $request->input("hashName") . "%");
        }

        //位置で検索
        //エリア
        if ($request->input("areaId")){
            $posts = $posts->whereAreaId($request->input("areaId"));
        }
        //都道府県
        if ($request->input("prefectureId")){
            $posts = $posts->wherePrefectureId($request->input("prefectureId"));
        }
        //都道府県エリア
        if ($request->input("prefectureAreaId")){
            $posts = $posts->wherePrefectureAreaId($request->input("prefectureAreaId"));
        }
        //市区
        if ($request->input("cityId")){
            $posts = $posts->whereCityId($request->input("cityId"));
        }

        $posts = $posts->get();



        foreach ($posts as $key => $post){
            $posts[$key]["hashes"] = $post->hashes;
            $posts[$key]["categories"] = $post->categories;
            $posts[$key]["user"] = $post->user;

            if ($post->imageOne){
                $posts[$key]->image = $post->imageOne->image;
            }else{
                $posts[$key]->image = "";
            }

            unset($post->latlng);
        }

        return $ApiClass->responseOk(["datas" => $posts]);
    }

    /**
     * マップの取得
     */
    public function map(ApiClass $ApiClass, Post $Post, Request $request)
    {
        $posts = $Post
            ->latlng();

        $request->input("topRightLat");
        $request->input("topRightLng");
        $request->input("bottomLeftLat");
        $request->input("bottomLeftLng");

        $posts = $posts->where(\DB::raw("X(latlng)"), "<=", $request->input("topRightLat"));
        $posts = $posts->where(\DB::raw("Y(latlng)"), "<=", $request->input("topRightLng"));
        $posts = $posts->where(\DB::raw("X(latlng)"), ">=", $request->input("bottomLeftLat"));
        $posts = $posts->where(\DB::raw("Y(latlng)"), ">=", $request->input("bottomLeftLng"));



        if ($request->input("keyword")){
            $posts = $posts
                ->where(function($query) use($request){
                    $query->orWhere("body", "LIKE", "%" . $request->input("keyword") . "%");
                    $query->orWhere("point", "LIKE", "%" . $request->input("keyword") . "%");
                });
        }

        $posts = $posts->get();

        return $ApiClass->responseOk(["datas" => $posts]);

    }

    /**
     * ユーザーごとの項目の取得
     * @param  ApiClass  $ApiClass
     * @param  Post  $Post
     * @return void
     */
    public function user(int $userId, ApiClass $ApiClass, Post $Post)
    {
        $posts = $Post->whereUserId($userId)->get();

        foreach ($posts as $key => $post){
            $posts[$key]["user"] = $post->user;

            if ($post->imageOne){
                $posts[$key]->image = $post->imageOne->image;
            }

            unset($posts[$key]->latlng);
        }
        return $ApiClass->responseOk(["data" => $posts]);
    }

    /**
     * FINDを送信
     *
     * @param  ApiClass  $ApiClass
     * @param  Post  $Post
     * @param  Request  $request
     * @param  UserPoint  $UserPoint
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function save(ApiClass $ApiClass, Post $Post, Request $request, UserPoint $UserPoint)
    {


        $data = $request->input("data");


        /*
        $data = [
            "date" => "2020-10-15",
            "point" => "東京都中央区勝どき6",
            "body" => "すごく良いところでした。是非、一緒にいきましょう。",
            "evaluation" => 5,
            "hashes" => [0 => "寺"],
            "categories" => ["京都"]
        ];
        */


        $Post->saveEntry(Auth::user()->id, $data);

        $user = Auth::user();
        $UserPoint->add($user, "post");

        return $ApiClass->responseOk();
    }

    /**
     * Nowの表示
     * @param  ApiClass  $ApiClass
     * @param  Post  $Post
     * @param  PostClass  $PostClass
     * @param  Request  $request
     * @param  PostLike  $PostLike
     * @param  UserFollower  $UserFollower
     * @param  PostReply  $PostReply
     * @return object
     */
    public function now(ApiClass $ApiClass, Post $Post, PostClass $PostClass, Request $request, PostLike $PostLike, UserFollower $UserFollower, PostReply $PostReply)
    {
        $if = "(CASE WHEN user_followers.id > 0 THEN '1'"
             . " ELSE '0' END) as follower_id";


        $nows = $PostReply
            ->select(\DB::raw("post_replies.comment as comment, 'replay' as type, replies.id as id, replies.body, replies.created_at,replies.point,replies.user_id,replies.count_like,replies.count_follower,replies.count_reply," . $if))
            ->leftJoin("posts as replies", "replies.id", "=", "post_replies.post_id")
            ->leftJoin("user_followers", "post_replies.user_id", "=", "user_followers.user_id");

        $nows = $Post
            ->select(\DB::raw("'' as comment, 'post' as type, posts.id as id, posts.body, posts.created_at,posts.point,posts.user_id,posts.count_like,posts.count_follower,posts.count_reply," . $if))
            ->leftJoin("user_followers", "posts.user_id", "=", "user_followers.user_id")
            ->union($nows)
            ->orderBy("follower_id", "DESC")
            ->orderBy("created_at", "DESC");
        //->where("posts.user_id", "<>", Auth::user()->id)



        if ($request->input("keyword")){
            $nows = $nows
                ->where(function($query) use($request){
                    $query->orWhere("posts.point", "LIKE", "%" . $request->input("keyword") . "%")
                        ->orWhere("posts.body", "LIKE", "%" . $request->input("keyword") . "%")
                    ;
                });
        }

        $nows->navigation(30);

        $nows = $nows->get();


        foreach ($nows as $key => $now){
            $nows[$key]->user = $now->user;

            //画像の取得
            if ($nows[$key]->imageOne){
                $nows[$key]->image = $nows[$key]->imageOne->image;
            }

            //カテゴリ
            if ($nows[$key]->categories){
                foreach ($nows[$key]->categories as $key2 => $category){
                    $nows[$key]->categories[$key2]->category = $category->subCategory;
                }
            }

            $nows[$key] = $PostClass->getLikes($now);

        }
        return $ApiClass->responseOk(["datas" => $nows]);
    }

    public function get(int $postId, ApiClass $ApiClass, Post $Post, PostClass $PostClass, Request $request)
    {
        $post = $Post->find($postId);

        $categories = $post->categories;
        $post->categories = $post->categories;
        $post->user = $post->user;

        foreach ($categories as $key => $category)
        {
            $post->categories[$key]->subCategory = $category->subCategory;
        }

        $post->isLike = false;
        $post->isFollower = false;
        $post->isLike = false;

        $post->typeName = configJson("postType")[$post->type];

        unset($post->latlng);

        $post->images = $post->images;
        $post->user = $post->user;

        $post = $PostClass->getLikes($post);

        return $ApiClass->responseOk(["data" => $post]);
    }
}
