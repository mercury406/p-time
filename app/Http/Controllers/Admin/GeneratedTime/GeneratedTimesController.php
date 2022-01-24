<?php

namespace App\Http\Controllers\Admin\GeneratedTime;

use App\Models\City;
use App\Models\Maintime;
use Illuminate\Http\Request;
use App\Models\GeneratedTime;
use App\Http\Controllers\Controller;

class GeneratedTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(City $city, Request $request)
    {
        $times = explode("\r\n", $request->data);

        $formatted = [];

        foreach($times as $time){
            $exploded = explode("\t", $time);
            $formatted[] = [
                "date" => date_create_from_format("m/d/Y", $exploded[0]),
                "tong" => $exploded[1],
                "quyosh" => $exploded[2],
                "peshin" => $exploded[3],
                "asr" => $exploded[4],
                "shom" => $exploded[5],
                "hufton" => $exploded[6],
            ];
        }

        $betweenDates = [ 
            $formatted[0]["date"]->format("Y-m-d"),  // mindate given
            $formatted[ count($times) - 1 ]["date"]->format("Y-m-d") // maxdate given
        ];

        $maintimes = Maintime::whereBetween("greg_date", $betweenDates)->get();
        dd($maintimes);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\City
     * @return \Illuminate\Http\Response
     */
    public function create(City $city)
    {
        return view('admin.generated_time.create', compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeneratedTime  $generatedTime
     * @return \Illuminate\Http\Response
     */
    public function show(GeneratedTime $generatedTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeneratedTime  $generatedTime
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneratedTime $generatedTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneratedTime  $generatedTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneratedTime $generatedTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeneratedTime  $generatedTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneratedTime $generatedTime)
    {
        //
    }
}
