<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

/**
*	管理ユーザー管理
*/
class AdminUserController extends AdminController
{

  public function __construct(){
	  	parent::__construct();

        $this->model = new Admin();
        $this->setUploadType($this->model);

        \View::Share('layoutListUrl', route('admin.admin_user.index'));
  }


    /**
     * 一覧の表示
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
		//値の取得
		$lists = $this->model->orderBy("id", "DESC");


		$lists = $lists->paginate(config('admins.pages')['paginate']);

		return view('admins.admin_users.index',[
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
        return view('admins.admin_users.input',[
            'inputs' => [],
        ]);
    }

    /**
     * データの保存
     * @param  advertisementRequest  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(UserRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.admin_users.input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $inputs = $request->input();

            $this->model->saveEntry($inputs);


            return redirect()->route('admin.admin_user.index', ["mode" => "success", "is_pay" => \Session::get("is_pay")]);
        }
    }

    public function edit(int $id){
        $inputs = $this->model->where(['id' => $id])->first();

        //show.
        return view('admins.admin_users.input',[
            'inputs' => $inputs,
            "id" => $id,
        ]);
    }

    public function update(int $id, UserRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.admin_users.input',[
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


            return redirect()->route('admin.admin_user.index', ["mode" => "success", "is_pay" => \Session::get("is_pay")]);
        }
    }

    //削除
    public function destroy($id){


      $this->model->find($id)->delete();

      return redirect()->route('admin.admin_user.index',['reflash' => 'destory']);
    }



}
