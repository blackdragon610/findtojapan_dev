<?php

namespace App\Libs;

/*
*	SMSの処理
*/

use App\Models\User;
use App\Models\UserSms;
use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;

class SmsClass{
public UserSms $UserSms;
public User $User;

    function __construct(UserSms $UserSms, UserClass $UserClass)
    {
        $this->UserSms = $UserSms;
        $this->UserClass = $UserClass;
    }


    public function smsCheck(string $secret, string $tel, string $password) :bool
    {
        $UserSms = clone $this->UserSms;
        $result = false;

        $UserSms->setTransaction("ユーザー登録時にエラーがありました", function() use($tel, $UserSms, $secret, $password, &$result){
            //一時間前のものは消去
            $UserSms->where("created_at", "<=", date("Y-m-d H:i:s", time() - 3600))
                ->delete();

            //コード認証
            $UserSms = clone $this->UserSms;
            $userSms = $UserSms
                ->where("secret", $secret)
                ->where("tel", $tel)
                ->first();

            if (!$userSms)
            {
                $result = false;
                return;
            }

            //登録がある場合はパスワードの変更のみ
            $User = app("User");

            $data["tel"] = $userSms->tel;
            $data["onoff"] = 1;

            if ($User = $User->whereTel($data["tel"])->first()){
                $User->changePassword();
                $User->save();

            }else{
                //ユーザーの登録
                $data["password"] = $password;

                $this->UserClass->saveEntry($data);
            }

            //該当SMSの削除
            $userSms->delete();

            $result = $data["tel"];
        });

        return $result;
    }
    /**
     * ユーザーの電話番号のSMSの登録と送信
     * @param  string  $tel
     */
    public function smsEntry(string $tel)
    {
        $UserSms = clone $this->UserSms;

        $UserSms->setTransaction("SMS登録時にエラーが発生しました。", function() use($UserSms, $tel){
            $secret = mt_rand(10000, 99999);

            $UserSms->tel = $tel;
            $UserSms->secret = $secret;
            $UserSms->save();

            $this->sendSms($tel, "とびちゃアプリの認証コードです。(有効期限は一時間です):" . $secret);
        });

    }

    /**
     * SMSの送信
     * @param  string  $tel 電話番号
     * @param  string  $text    テキスト
     * @throws Client\Exception\Request
     * @throws Client\Exception\Server
     */
    public function sendSms(string $tel, string $text)
    {
        $to = "81" . substr($tel, 1, strlen($tel));

        $sms = config("sms");
        $basic  = new Basic($sms["API_KEY"], $sms["API_SECRET"]);
        $client = new Client($basic);


        $message = $client->message()->send([
                    'type' => 'unicode',
                    'to' => $to,
                    'from' => "buttobi",
                    'text' => $text
        ]);

    }
}

