<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;

    protected $fillable = ["last_update_id", "last_message_id", "tg_user_id", "language", "step", "region_id", "city_id", "is_subscribed"];
}
