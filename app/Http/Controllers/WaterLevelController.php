<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\River;
use App\WaterLevel;

class WaterLevelController extends Controller
{
    public function store(Request $request)
    {
        $data = explode('/', $request->getContent());

        $channel = $data[4];

        $river = River::whereChannel($channel)->first();

        WaterLevel::create([
            'entry_id' => '1',
            'level'       => trim(preg_replace('/\s+/', ' ', $data[1])),
            'temperature' => trim(preg_replace('/\s+/', ' ', $data[2])),
            'velocity'   => trim(preg_replace('/\s+/', ' ', $data[0])),
            'date_taken' => $data[3],
            'river_id'   => $river->id
        ]);

    }

    public function getWaterLevel($id, Request $request)
    {
        $levels = River::find($id)->waterLevels;

        if($request->from_date && $request->to_date){
            $levels = $levels->whereBetween('date_taken', array($request->from_date, $request->to_date));
        }

        return datatables()->of($levels)->make(true);
    }
}
