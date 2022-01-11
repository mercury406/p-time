<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        $regions = Region::all();
        $cities = City::all();
        return view('admin.index', compact('regions', 'cities'));
    }
}
