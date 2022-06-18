<?php 

namespace App\Http\Services;

use App\Http\Enums\LanguangeEnum;
use App\Http\Traits\RemoteRequest;
use App\Http\Traits\TelegramMethods;
use App\Models\City;
use App\Models\Region;
use App\Models\TelegramUser;

class TelegramService{

    // use RemoteRequest;
    // use TelegramMethods;
    
    // private $method;
    // private $data;

    // public function getUpdates() {
    //     $this->method = "getUpdates";
    //     $this->clearData();
    //     $response = $this->makeRequest();
    //     return is_null($response) ? ["error" => "null"] : json_decode($response);
    // }

    // public function subscribeUser(int $user_id){
    //     $tg_user = TelegramUser::firstOrNew(["tg_user_id" => $user_id]);
    //     $tg_user->is_subscribed = 1;
    //     $is_new_user = !isset($tg_user->id);

    //     $tg_user->save();

    //     if($is_new_user || $tg_user->step == 1) $tg_user->sendGreetings();

    //     return "subsribed $user_id";
    // }

    // public function unsubscribeUser(int $user_id){
    //     $tg_user = TelegramUser::firstOrNew(["tg_user_id" => $user_id]);
    //     $tg_user->is_subscribed = 0;
    //     $tg_user->step = 1;
    //     $tg_user->language = null;
    //     $tg_user->region_id = null;
    //     $tg_user->city_id = null;
    //     $tg_user->save();
    //     return "unsubsribed $user_id";
    // }

    // public function setLanguage(int $user_id, string $lang, int $message_id)
    // {
    //     $tg_user = TelegramUser::firstOrNew(["tg_user_id" => $user_id]);
    //     $tg_user->step = 2;
    //     $tg_user->language = $lang;
    //     $tg_user->save();
        
    //     $this->deleteMessage($tg_user->tg_user_id, $message_id);

    //     return $tg_user->sendDistrictList();
        
    // }

    // public function setRegion(int $user_id, int $region_id, int $message_id)
    // {
    //     $tg_user = TelegramUser::firstOrNew(["tg_user_id" => $user_id]);
    //     $tg_user->step = 3;
    //     if( is_null($tg_user->id) ) $tg_user->language = LanguangeEnum::UZBEK;
    //     $tg_user->region_id = $region_id;
    //     $tg_user->save();

    //     $this->deleteMessage($tg_user->tg_user_id, $message_id);


    //     return $tg_user->sendCityList(Region::find($region_id)->first());
    // }

    // public function setCity(int $user_id, int $city_id, int $message_id)
    // {
    //     $tg_user = TelegramUser::firstOrNew(["tg_user_id" => $user_id]);
    //     $city = City::find($city_id) ?? City::first();
    //     $tg_user->step = 4;

    //     if( is_null($tg_user->id) ) {
    //         $tg_user->language = LanguangeEnum::UZBEK;
    //         $tg_user->region_id = $city->region->id;
    //     }

    //     $tg_user->city_id = $city->id;
        
    //     $tg_user->save();
     
    //     $this->deleteMessage($tg_user->tg_user_id, $message_id);
        
    // }

    
}