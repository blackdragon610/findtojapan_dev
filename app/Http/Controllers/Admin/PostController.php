<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\PostRequest;
use App\Http\Requests\QaRequest;
use App\Models\Post;
use Illuminate\Http\Request;

/**
*	投稿管理
*/
class PostController extends AdminController
{

  public function __construct(){
	  	parent::__construct();

        $this->model = new Post();

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

		return view('admins.posts.index',[
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
        return view('admins.posts.input',[
            'inputs' => [],
        ]);
    }

    /**
     * データの保存
     * @param  advertisementRequest  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(PostRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.posts.input',[
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
        return view('admins.posts.input',[
            'inputs' => $inputs,
            "id" => $id,
        ]);
    }

    public function update(int $id, PostRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('admins.posts.input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                "id" => $id,
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $inputs = $request->input();
            $inputs["id"] = $id;

            $this->model->saveEntryAdmin($inputs["user_id"], $inputs);


            return redirect()->route('admin.post.index', ["mode" => "success", "is_coupon" => \Session::get("is_coupon")]);
        }
    }

    //削除
    public function destroy($id){


      $this->model->find($id)->delete();

      return redirect()->route('admin.qa.index',['reflash' => 'destory']);
    }



}
