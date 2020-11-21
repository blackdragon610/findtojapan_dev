<?php

namespace App\Http\Controllers\Company;
use App\Http\Requests\UserRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

/**
*	ユーザー管理
*/
class UserController extends CompanyController
{

  public function __construct(){
	  	parent::__construct();

        $this->model = new Company();
        $this->setUploadType($this->model);

        \View::Share('layoutListUrl', route('admin.user.index'));
  }





    public function edit(int $id){
        $model = $this->model->where(['id' => Auth::guard("company")->user()->id])->first();
        $model->setView();
        $inputs = $model;

        unset($inputs["password"]);

        //show.
        return view('companies.users.input',[
            'inputs' => $inputs,
            "id" => $id,
        ]);
    }

    public function update(int $id, UserRequest $request)
    {
        $inputs = $request->input();
        $inputs["id"] = Auth::guard("company")->user()->id;

        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('companies.users.input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                "id" => $id,
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $this->model->saveEntry($inputs);


            return redirect()->route('company.user.edit', ["user" => 5, "mode" => "success"]);
        }
    }



}
