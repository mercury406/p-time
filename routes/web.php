<?php

use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('viloyat/{region:slug}', function (Region $region) {
    return $region;
})->name('viloyats.show');

Route::get('shahar/{city}', function (City $city) {
    return $city;
})->name('shahars.show');


Route::group(["prefix" => "admin", "as" => "admin."], function() {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::resource('shahars', \App\Http\Controllers\Admin\City\CityController::class);
    Route::resource('viloyats', \App\Http\Controllers\Admin\Region\RegionController::class)->parameters([
        'viloyats' => 'region'
    ]);
    Route::get('check-viloyat-slug/{region?}', [\App\Http\Controllers\Admin\Region\RegionController::class, 'checkSlug'])->name('viloyats.check-slug');
});