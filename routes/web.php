<?php

use App\Models\City;
use App\Models\Maintime;
use App\Models\Region;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    phpinfo();
});

Route::get('viloyat/{region:slug}', function (Region $region) {
    return $region;
})->name('viloyats.show');

Route::get('shahar/{city:slug}', function (City $city) {
    return $city;
})->name('shahars.show');


Route::group(["prefix" => "admin", "as" => "admin."], function() {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');

    Route::get("/telegramUpdates", [\App\Http\Controllers\Admin\TelegramController::class, "updates"]);

    Route::resource('shahars', \App\Http\Controllers\Admin\City\CityController::class)->parameters([
        'shahars' => 'city' 
    ]);
    Route::resource('viloyats', \App\Http\Controllers\Admin\Region\RegionController::class)->parameters([
        'viloyats' => 'region'
    ]);

    Route::resource('shahars.time', \App\Http\Controllers\Admin\GeneratedTime\GeneratedTimesController::class)->parameters([
        "shahars" => 'city',
        "time" => "generated_time"
    ])->except(['index']);
    Route::post('shahars/{city}/time/generete', 
        [\App\Http\Controllers\Admin\GeneratedTime\GeneratedTimesController::class, 'generate'])
        ->name('shahars.time.generate');
    

    Route::get('check-city-slug/{region?}', [\App\Http\Controllers\Admin\City\CityController::class, 'checkSlug'])->name('shahars.check-slug');
    Route::get('check-viloyat-slug/{city?}', [\App\Http\Controllers\Admin\Region\RegionController::class, 'checkSlug'])->name('viloyats.check-slug');

    Route::resource('maintimes', \App\Http\Controllers\Admin\Maintime\MaintimeController::class)->except(["show"]);
    Route::post('maintimes/generate', [\App\Http\Controllers\Admin\Maintime\MaintimeController::class, "generate"])->name('maintimes.generate');

    Route::get("server", [\App\Http\Controllers\Admin\AdminController::class, 'viewForServer'])->name("viewForServer");
    Route::post("server", [\App\Http\Controllers\Admin\AdminController::class, 'generatedForServer'])->name("generatedForServer");

    // Route::get("update-maintime", function() {
    //     $maintimes = Maintime::all();
    //     foreach($maintimes as $m) {
    //         $m->update(["qamar_date" => date('d-m-Y', $m->qamar_date)]);
    //     }

    //     return redirect()->route('admin.maintimes.index');
    // });
});