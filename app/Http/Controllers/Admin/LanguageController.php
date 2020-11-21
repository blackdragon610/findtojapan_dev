<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

/**
*	言語管理
*/
class LanguageController extends AdminController
{

  public function __construct(){
	  	parent::__construct();

        $this->model = new Language();

        \View::Share('layoutListUrl', route('admin.language.index'));
  }


    /**
     * 一覧の表示
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
		//値の取得
		$lists = $this->model->orderBy("id", "DESC");

        $inputs = $request->input();

        if ($request->input("search")){
            if ($request->input("language")){
                $lists = $lists->where("language", $request->input("language"));
            }
            if ($request->input("from")){
                $lists = $lists->where("from", "LIKE", "%" . $request->input("from") . "%");
            }
            if ($request->input("body")){
                $lists = $lists->where("body", "LIKE", "%" . $request->input("body") . "%");
            }
        }

		$lists = $lists->paginate(config('admins.pages')['paginate']);

		return view('admins.languages..index',[
				'lists' => $lists,
                "inputs" => $inputs,
			]
		);
	}


    /**
     * データの新規作成
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
	    //show.
        return view('admins.languages..input',[
            'inputs' => [],
        ]);
    }

    /**
     * データの保存
     * @param  advertisementRequest  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(LanguageRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.languages..input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $inputs = $request->input();

            $this->model->saveEntry($inputs);


            return redirect()->route('admin.language.index', ["mode" => "success", "is_coupon" => \Session::get("is_coupon")]);
        }
    }

    public function edit(int $id){
        $inputs = $this->model->where(['id' => $id])->first();

        //show.
        return view('admins.languages..input',[
            'inputs' => $inputs,
            "id" => $id,
        ]);
    }

    public function update(int $id, LanguageRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.languages..input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                "id" => $id,
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $inputs = $request->input();
            $inputs["id"] = $id;


            $this->model->saveEntry($inputs);


            return redirect()->route('admin.language.index', ["mode" => "success", "is_coupon" => \Session::get("is_coupon")]);
        }
    }

    //削除
    public function destroy($id){


      $this->model->find($id)->delete();

      return redirect()->route('admin.language.index',['reflash' => 'destory']);
    }

    /**
     * google
     */
    public function google()
    {
        $this->model->adds();

        return redirect()->route('admin.language.index',['mode' => 'success']);
    }



}
