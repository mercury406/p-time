<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::resource("/regions", ApiController::class)->only(["index", "show"]);

Route::get("/time/{city}", [ApiController::class, "getTime"]);