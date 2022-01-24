<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class City extends Model
{
    use HasFactory;
    use HasTranslations;
    
    protected $fillable = ['slug', 'title'];
    public $translatable = ['title'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function generated_times()
    {
        return $this->hasMany(GeneratedTime::class);
    }


}
