<?php


namespace App\Console\Commands;

use App\Libs\PushClass;
use App\Models\PushWait;
use App\DripEmailer;
use Illuminate\Console\Command;


class PushCommand extends Command
{
    protected $signature = 'command:Push';
    protected $description = 'TEST';

    public function handle(PushWait $PushWait, PushClass $PushClass){
        $datas = $PushWait->get();


        foreach ($datas as $data){
            $pushType = $data->pushType;
            $chat = $pushType->chat;
            $user = $data->user;

            $datas = [
                "mode" => $pushType->type,
                "id" => $chat->chat_id
            ];

            if (count($user->tokens)){
                foreach ($user->tokens as $token){
                    $PushClass->sendPush($token->token, "ぶっとびからお知らせがありました", $chat->body, $user->id, $datas);
                }
            }


            $data->delete();
        }

        exit();
    }

}
