<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Api\TimeResource;
use App\Http\Resources\Api\LocationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiController extends Controller
{
    public function index(): JsonResource
    {
        return LocationResource::collection(Region::all());

    }

    public function show(Region $region): JsonResource
    {
        return LocationResource::collection($region->cities);
    }

    public function getTime(Request $request, City $city): JsonResource
    {
        $date = $request->query("date") == "tomorrow" 
                    ? Carbon::tomorrow()->toDateString() 
                    : Carbon::now()->toDateString();

        $dates = $city->generated_times->where("gregorian_date", $date);
        return TimeResource::collection($dates);
    }

}

