<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\QaRequest;
use App\Models\Qa;
use Illuminate\Http\Request;

/**
*	よくある質問管理
*/
class QaController extends AdminController
{

  public function __construct(){
	  	parent::__construct();

        $this->model = new Qa();

        \View::Share('layoutListUrl', route('admin.qa.index'));
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


		$lists = $lists->paginate(config('admins.pages')['paginate']);

		return view('admins.qas.index',[
				'lists' => $lists,
			]
		);
	}


    /**
     * データの新規作成
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
	    //show.
        return view('admins.qas.input',[
            'inputs' => [],
        ]);
    }

    /**
     * データの保存
     * @param  advertisementRequest  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(QaRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.qas.input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $inputs = $request->input();

            $this->model->saveEntry($inputs);


            return redirect()->route('admin.qa.index', ["mode" => "success", "is_coupon" => \Session::get("is_coupon")]);
        }
    }

    public function edit(int $id){
        $inputs = $this->model->where(['id' => $id])->first();

        //show.
        return view('admins.qas.input',[
            'inputs' => $inputs,
            "id" => $id,
        ]);
    }

    public function update(int $id, QaRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.qas.input',[
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


            return redirect()->route('admin.qa.index', ["mode" => "success", "is_coupon" => \Session::get("is_coupon")]);
        }
    }

    //削除
    public function destroy($id){


      $this->model->find($id)->delete();

      return redirect()->route('admin.qa.index',['reflash' => 'destory']);
    }



}
