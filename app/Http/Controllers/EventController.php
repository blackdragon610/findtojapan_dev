<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    /**
     * 全項目の取得
     * @param  ApiClass  $ApiClass
     * @param  Event  $Event
     * @param  EventUser  $EventUser
     * @param  Request  $request
     * @return object
     */
    public function list(ApiClass $ApiClass, Event $Event, Request $request)
    {

        $events = $Event->whereView()->get();

        foreach ($events as $key => $event){
            $events[$key]->company = $event->company;
            $events[$key]->isJoin = false;

            if ($event->eventUserMy){
                $events[$key]->isJoin = true;
            }
        }
        return $ApiClass->responseOk(["data" => $events]);
    }

    /**
     * 詳細取得
     * @param  int  $eventId
     * @param  ApiClass  $ApiClass
     * @param  Event  $Event
     * @param  Request  $request
     * @return object
     */
    public function detail(int $eventId, ApiClass $ApiClass, Event $Event)
    {
        $event = $Event->find($eventId);
        $event->company = $event->company;

        //参加しているか否か？
        $event->isJoin = false;

        if ($event->eventUserMy){
            $event->isJoin = true;
        }

        return $ApiClass->responseOk(["data" => $event]);
    }

    /**
     * 参加する
     * @param  int  $eventId
     * @param  ApiClass  $ApiClass
     * @param  EventUser  $EventUser
     * @param  Request  $request
     * @return object
     */
    public function join(int $eventId, ApiClass $ApiClass, EventUser $EventUser)
    {
        $EventUser->saveEntry($eventId, Auth::user()->id);

        return $ApiClass->responseOk();
    }

    /**
     * 参加取り消し
     * @param  int  $eventId
     * @param  ApiClass  $ApiClass
     * @param  EventUser  $EventUser
     * @param  Request  $request
     * @return object
     */
    public function unjoin(int $eventId, ApiClass $ApiClass, EventUser $EventUser)
    {
        $EventUser->saveDestroy($eventId, Auth::user()->id);

        return $ApiClass->responseOk();
    }

}
