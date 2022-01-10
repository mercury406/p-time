<?php 


namespace App\Http\Services;

use App\Models\Region;
use Illuminate\Support\Str;

class SlugGenerator{


    public static function generate(string $model, string $fromString, string $separator = '')
    {   
        $model = new $model;
        $possibleSlug = Str::slug($fromString, $separator);
        while($model->where('slug', $possibleSlug)->count() > 0 ){
            $possibleSlug .= "1";
        }

        return $possibleSlug;
    }

    public static function checkRegion(string $slug, bool $isNew = true, Region $region = null) {
        info($isNew);
        return $isNew 
                    ? Region::where('slug', $slug)->count() < 1
                    : Region::where(['slug' => $slug])->whereNotIn('id', [$region->id])->count() < 1;
    }
}