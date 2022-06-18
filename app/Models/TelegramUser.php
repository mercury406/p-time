<?php

namespace App\Models;

use App\Http\Traits\TelegramMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;
    use TelegramMethods;

    protected $fillable = ["tg_user_id", "language", "step", "region_id", "city_id", "is_subscribed"];

    public function sendGreetings()
    {
        return $this->sendGreetingWithId($this->tg_user_id);
    }

    public function sendDistrictList()
    {
        return $this->sendRegionListWithTgUser($this);
    }

    public function sendCityList(Region $region){
        return $this->sendCityListWithTgUser($this, $region);
    }

}
