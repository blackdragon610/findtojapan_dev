<?php

namespace App\Http\Controllers;

use App\Libs\ApiClass;
use App\Models\UserFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{

    public function save(int $userId, ApiClass $ApiClass, UserFollower $UserFollower)
    {
        $count = $UserFollower->saveEntry(Auth::user()->id, $userId);

        return $ApiClass->responseOk(["count" => $count]);
    }

    public function destroy(int $userId, ApiClass $ApiClass, UserFollower $UserFollower)
    {
        $count = $UserFollower->saveDestroy(Auth::user()->id, $userId);

        return $ApiClass->responseOk(["count" => $count]);
    }
}
