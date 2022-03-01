<?php

namespace App\Http\Controllers\Admin;

use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\TelegramService;
use Illuminate\Database\QueryException;

class TelegramController extends Controller
{
    //
    protected TelegramService $service;
    

    public function __construct(TelegramService $telegramService)
    {
        $this->service = $telegramService;
    }
    

    public function updates()
    {
        $response = $this->service->getUpdates();
        
        if(!$response->ok) return ["Result" => "Error in request", "data" => $response];

        if(!isset($response->result)) return ["Result" => "No updates 1"];
                
        if(count($response->result) < 1) return ["Result" => "No updates 2"];
        
        $last_update = end($response->result);

        if(isset($last_update->message)) {

            $tg_user = TelegramUser::firstOrNew(
                ["tg_user_id" => $last_update->message->from->id],
                [
                    "last_update_id" => $last_update->update_id,
                    "last_message_id" => $last_update->message->message_id,
                    "is_subscribed" => true
                ]
            );
    
            $is_new_user = !isset($tg_user->id);
            $tg_user->save();
    
            if($is_new_user || $tg_user->step == 1) {
                return $this->service->sendGreeting($tg_user->tg_user_id);
            }

        }

        if(isset($last_update->my_chat_member->chat) && $last_update->my_chat_member->new_chat_member->status === "kicked"){
            $tg_user = TelegramUser::where("tg_user_id", $last_update->my_chat_member->chat->id)->firstOrFail();

            $tg_user->update([
                "last_update_id" => $last_update->update_id,
                "last_message_id" => -1,
                "step" => 1,
                "is_subscribed" => false
            ]);
            
            $tg_user->save();

            return ["Result" => "$tg_user->tg_user_id отписался от бота"];
            
        }
        
                
    }
}
