<?php

use App\Models\City;
use App\Models\Maintime;
use App\Models\Region;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::get("viloyat/{region:slug}", function (Region $region) {
    return $region;
})->name("viloyats.show");

Route::get("shahar/{city:slug}", function (City $city) {
    return $city;
})->name("shahars.show");


Route::group(["prefix" => "admin", "as" => "admin."], function() {
    Route::get("/", [\App\Http\Controllers\Admin\AdminController::class, "index"])->name("index");

    Route::get("/telegramUpdates", [\App\Http\Controllers\Admin\TelegramController::class, "updates"])->name("telegram.updates");

    Route::resource("shahars", \App\Http\Controllers\Admin\City\CityController::class)->parameters([
        "shahars" => "city" 
    ]);
    Route::resource("viloyats", \App\Http\Controllers\Admin\Region\RegionController::class)->parameters([
        "viloyats" => "region"
    ]);

    Route::resource("shahars.time", \App\Http\Controllers\Admin\GeneratedTime\GeneratedTimesController::class)->parameters([
        "shahars" => "city",
        "time" => "generated_time"
    ])->except(["index"]);
    Route::post("shahars/{city}/time/generete", 
        [\App\Http\Controllers\Admin\GeneratedTime\GeneratedTimesController::class, "generate"])
        ->name("shahars.time.generate");
    

    Route::get("check-city-slug/{region?}", [\App\Http\Controllers\Admin\City\CityController::class, "checkSlug"])->name("shahars.check-slug");
    Route::get("check-viloyat-slug/{city?}", [\App\Http\Controllers\Admin\Region\RegionController::class, "checkSlug"])->name("viloyats.check-slug");

    Route::resource("maintimes", \App\Http\Controllers\Admin\Maintime\MaintimeController::class)->except(["show"]);
    Route::post("maintimes/generate", [\App\Http\Controllers\Admin\Maintime\MaintimeController::class, "generate"])->name("maintimes.generate");

    Route::get("server", [\App\Http\Controllers\Admin\AdminController::class, "viewForServer"])->name("viewForServer");
    Route::post("server", [\App\Http\Controllers\Admin\AdminController::class, "generatedForServer"])->name("generatedForServer");

    Route::get("ramazon", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "index"])->name("ramazon.index");
    Route::get("ramazon/change", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "changeStatus"])->name("ramazon.change");
    Route::put("ramazon/edit", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "edit"])->name("ramazon.edit");
    Route::post("ramazon/create", [\App\Http\Controllers\Admin\Ramazon\RamazonController::class, "create"])->name("ramazon.create");
});




// Route::group(["prefix" => "download"], function() {
//     Route::get("/regions", function () {
//         $regionsData = json_decode(Http::get("https://namozvaqti.uz/regions/all"), true);
//         $regions = $regionsData["data"];
//         foreach($regions as $region) {
//             Region::create($region);
//         }
//     });

//     Route::get("/cities", function() {
//         $regionsList = Region::all();
//         foreach($regionsList as $region) {
//             $citiesData = json_decode(Http::get("https://namozvaqti.uz/regions/$region->slug"), true);
//             $cities = $citiesData["data"];
//             foreach($cities as $city){
//                 $region->cities()->create($city);
//             }
//         }
//         return City::count();
//     });

//     Route::get("/maintimes", function(){
//         $data = json_decode(Http::get("https://namozvaqti.uz/download/maintimes"), true);
//         $maintimes = $data["data"];
//         foreach($maintimes as $maintime) {
//             Maintime::create($maintime);
//         }
//     });

//     Route::get("/time", function() {
//         foreach(City::where("id", 13)->get() as $city) {
//             $timeData = json_decode(Http::get("https://namozvaqti.uz/download/city/$city->slug"), true);
//             $times = $timeData["data"];
//             foreach($times as $time) {
//                 $city->generated_times()->create($time);
//             }
//             info($city->getTranslation("title", "en") . " time added: " . $city->generated_times->count());
//         }
//     });

// });