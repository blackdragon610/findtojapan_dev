<?php


namespace App\Console\Commands;

use App\Libs\PayClass;
use App\DripEmailer;
use App\Models\User;
use Illuminate\Console\Command;


class PayCheckCommand extends Command
{
    protected $signature = 'command:payCheck';
    protected $description = 'TEST';

    public function handle(User $User, PayClass $PayClass){
        $users = $User
            ->where("is_pay", 0)
            ->where("is_user_pay", 1)
            ->get();

        foreach ($users as $user){
            if (!$PayClass->check($user->receipt)){
                $user->is_user_pay = 0;
                $user->save();
            }
        }

        exit();
    }

}
