<?php

namespace App\Http\Controllers\Company;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
*	イベント管理
*/
class EventController extends CompanyController
{

  public function __construct(){
	  	parent::__construct();

        $this->model = new Event();
        $this->setUploadType($this->model);

        \View::Share('layoutListUrl', route('company.event.index'));
  }


    /**
     * 一覧の表示
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
		//値の取得
		$lists = $this->model->orderBy("id", "DESC");

        $lists = $lists->whereUserId(Auth::guard("company")->user()->id);

		$lists = $lists->paginate(config('admins.pages')['paginate']);

		return view('companies.events.index',[
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
        return view('companies.events.input',[
            'inputs' => [],
        ]);
    }

    /**
     * データの保存
     * @param  advertisementRequest  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(EventRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('companies.events.input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $inputs = $request->input();

            $this->model->saveEntry(Auth::guard("company")->user()->id, $inputs);

            return redirect()->route('company.event.index', ["mode" => "success"]);
        }
    }

    public function edit(int $id){
        $inputs = $this->model->where(['id' => $id])->whereUserId(Auth::guard("company")->user()->id)->first();

        list($inputs["date_limit"], $inputs["time_limit"]) = explode(" ", $inputs["date_limit"]);

        //dd($inputs);
        //show.
        return view('companies.events.input',[
            'inputs' => $inputs,
            "id" => $id,
        ]);
    }

    public function update(int $id, EventRequest $request)
    {
        $datas = $this->checkForm($request);

        if ((!$request->input('end')) || (!empty($datas['errors']))){
            //確認画面か入力画面を表示させる
            return view('companies.events.input',[
                'errors' => $datas['errors'],
                'inputs' => $datas['inputs'],
                "id" => $id,
                'isConfirmation' => $datas['isConfirmation'],
            ]);
        }else{
            //登録完了
            $inputs = $request->input();
            $inputs["id"] = $id;

            $this->model->saveEntry(Auth::guard("company")->user()->id, $inputs);


            return redirect()->route('company.event.index', ["mode" => "success", "is_coupon" => \Session::get("is_coupon")]);
        }
    }

    //削除
    public function destroy($id){


      $this->model->whereId($id)
          ->whereUserId(Auth::guard("company")->user()->id)
          ->delete();

      return redirect()->route('admin.user.index',['reflash' => 'destory']);
    }

    public function participation(int $eventId, EventUser $EventUser)
    {
        $lists = $EventUser
            ->select(\DB::raw("event_users.*"))
            ->leftJoin("events", "events.id", "=", "event_users.event_id")
            ->where("events.user_id", Auth::guard("company")->user()->id)
            ->whereEventId($eventId)
            ->paginate();

        return view('companies.events.participation',[
            "lists" => $lists,
        ]);
    }



}
