<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use HasTranslations;
    
    protected $fillable = ['slug', 'title', "order"];
    public $translatable = ['title'];
    
    public function region() : BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function generated_times() : HasMany
    {
        return $this->hasMany(GeneratedTime::class);
    }

    public function today()
    {
        return $this->generated_times()->where("gregorian_date", date("Y-m-d"));
    }

    public function tomorrow()
    {
        return $this->generated_times()->where("gregorian_date", date("Y-m-d", strtotime("tomorrow")));
    }

    public function month(int $month = null)
    {
        if($month == null) $month = date("m");
        
        return $this->generated_times()->whereMonth("gregorian_date", $month)->whereYear("gregorian_date", date("Y"));
    }

    public function ramazon()
    {
        $ramazon = Ramazon::first();
        return $this->generated_times()->whereBetween("gregorian_date", [$ramazon->start_date, $ramazon->end_date]);
    }

}
