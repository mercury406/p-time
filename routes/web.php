<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/asd', function () {
    return view('welcome');
});


Route::group(["prefix" => "admin", "as" => "admin."], function() {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::resource('shahars', \App\Http\Controllers\Admin\City\CityController::class);
    Route::resource('viloyats', \App\Http\Controllers\Admin\Region\RegionController::class);
});