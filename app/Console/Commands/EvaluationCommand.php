<?php


namespace App\Console\Commands;

use App\Libs\ChatClass;
use App\Models\Reservation;
use Illuminate\Console\Command;


class EvaluationCommand extends Command
{
    protected $signature = 'command:evaluation';
    protected $description = 'TEST';

    public function handle(Reservation $Reservation, ChatClass $ChatClass){
        if (date("H:i:s", "18:00:00")){
            $reserations = $Reservation
                ->where("date_end", date("Y-m-d"))
                ->where("status", 1)
                ->get()
            ;

            foreach ($reserations as $reservation){
                $chat = $ChatClass->getFromReservationId($reservation->user_id, $reservation->id);

                if ($chat){
                    $chat = $chat->first();

                    $ChatClass->saveEntrySystem($chat->serial, "evaluation2", 0, ["reservation" => $reservation]);
                }
            }
        }

    }

}
