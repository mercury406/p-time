<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;


class Region extends Model
{
    use HasFactory;
    use HasTranslations;
    
    protected $fillable = ['slug', 'title'];
    public $translatable = ['title'];

}
