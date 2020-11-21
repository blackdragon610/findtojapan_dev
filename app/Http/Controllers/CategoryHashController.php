<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\Category;
use App\Models\Hash;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryHashController extends Controller
{

    /**
     * カテゴリの取得
     * @param  ApiClass  $ApiClass
     * @param  Category  $Category
     * @param  Request  $request
     * @return object
     */
    public function category(ApiClass $ApiClass, Category $Category, Request $request)
    {
        $categories = $Category->get();

        return $ApiClass->responseOk(["categories" => $categories]);
    }


    /**
     * サブカテゴリの取得
     * @param  ApiClass  $ApiClass
     * @param  SubCategory  $SubCategory
     * @param  Request  $request
     * @return object
     */
    public function subcategory(ApiClass $ApiClass, SubCategory $SubCategory, Request $request)
    {
        if ($request->input("categoryId")){
            $SubCategory = $SubCategory->whereCategoryId($request->input("categoryId"));
        }


        $subcategories = $SubCategory->get();

        return $ApiClass->responseOk(["subCategories" => $subcategories]);
    }

    /**
     * カテゴリとサブカテゴリをグループごとに
     * @param  ApiClass  $ApiClass
     * @param  Category  $Category
     * @param  Request  $request
     */
    public function categoryGroup(ApiClass $ApiClass, Category $Category, Request $request)
    {



        $categories = $Category->get();

        foreach ($categories as $key => $category){
            $results[$key]["id"] = $category->id;
            $results[$key]["name"] = $category->category_name;
            $results[$key]["groups"] = [];
            foreach ($category->subCategories as $key2 => $sub){
                $results[$key]["groups"][$sub->id] = $sub->sub_name;
            }
        }

        return $ApiClass->responseOk(["categories" => $results]);
    }

    /**
     * 人気のカテゴリ
     * @param  ApiClass  $ApiClass
     * @param  Category  $Category
     * @param  Request  $request
     * @return object
     */
    public function popularCategory(ApiClass $ApiClass, Category $Category, Request $request)
    {
        $categories = $Category
            ->limit(5)
            ->orderBy("count", "DESC")
            ->get();

        return $ApiClass->responseOk(["categories" => $categories]);
    }

    /**
     * ハッシュをランダムで出す
     * @param  ApiClass  $ApiClass
     * @param  Hash  $Hash
     * @param  Request  $request
     * @return object
     */
    public function hashRandom(ApiClass $ApiClass, Hash $Hash, Request $request)
    {
        $hashes = $Hash->orderBy(\DB::raw("RAND()"))->get();

        return $ApiClass->responseOk(["hashes" => $hashes]);
    }

    public function hashSearch(ApiClass $ApiClass, Hash $Hash, Request $request)
    {
        $hashes = $Hash->where("hash_name", "LIKE", "%" . $request->input("keyword") . "%")->get();

        return $ApiClass->responseOk(["datas" => $hashes]);
    }
}
