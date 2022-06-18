<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\Telegram\GetUpdates;
use App\Http\Actions\Telegram\SubscribeUser;
use App\Http\Controllers\Controller;
use App\Http\Services\TelegramService;
use Exception;

class TelegramController extends Controller
{
    //
    private TelegramService $service;
    

    public function __construct(TelegramService $telegramService)
    {
        $this->service = $telegramService;
    }
    

    public function updates()
    {
        // $response = $this->service->getUpdates();
        $response = (new GetUpdates())();
        
        if(!$response->ok) return ["Result" => "Error in request", "data" => $response];

        if(!isset($response->result)) return ["Result" => "No updates 1"];
                
        if(count($response->result) < 1) return ["Result" => "No updates 2"];
        
        $last_update = end($response->result);
        
        
        if(isset($last_update->message)) {
            return (new SubscribeUser($last_update->message->from->id))();
            // dd($subscribe);
            // return $subscribe();
        }

        // else if(isset($last_update->my_chat_member->chat) && $last_update->my_chat_member->new_chat_member->status === "kicked"){
        //     return $this->service->unsubscribeUser($last_update->my_chat_member->chat->id);
        // }

        // else if(isset($last_update->callback_query)) {
        //     $data = json_decode($last_update->callback_query->data);
        //     $user_id = $last_update->callback_query->from->id;
        //     $message_id = $last_update->callback_query->message->message_id;
        //     try{
        //         $func = $data->action;
        //         return $this->service->{$func}($user_id, $data->value, $message_id);
        //         // return ["result" => $data->value . " language set"];
        //     } catch (Exception $exception){
        //         return $exception->getMessage();
        //     }
        //     // return $data;
        //     // if()
        //     // $this->service->setLanguage($last_update->callback_query->from->id, $last_update->callback_query->data);
        // }
        
                
    }
}
