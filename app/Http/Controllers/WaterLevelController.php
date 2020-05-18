<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\River;
use App\WaterLevel;
use App\Sections;
use App\Discharge;



class WaterLevelController extends Controller
{
    public function store(Request $request)
    {
        $data = explode('/', $request->getContent());

        $channel = $data[4];

        $river = River::whereChannel($channel)->first();



        $labels = array();
        $dischargeArray = array();
        // $temp = River::where('id','=',$id)->first();
        $temp = River::whereChannel($channel)->first();
        $client = new Client();

        //query the water levels and velocities
        $waterLevels = $client->request('GET','https://api.thingspeak.com/channels/' . $temp->channel . '/feeds.json?api_key=' . $temp->key . '&results=1');
        $waterLevels = json_decode($waterLevels->getBody()->getContents()); 
        $waterLevels = $waterLevels->feeds;
        // dd($waterLevels);
        $discharge = 0.00;
        $totalDischarge = 0.00;
        // $sections = Sections::where('river_id','=',$id)->get();
        $sections = Sections::where('river_id','=',$river->id)->get();

        $count = $sections->count();
        $width = $temp->width;
        $height = $temp->height;
        $counter = 0; 

        foreach($waterLevels as $waterLevel){
            foreach ($sections as $section){
                if ($section->shape==0){
                    $ratio = $section->width*($height - $section->vertical_distance);
                    $area = (($ratio * $waterLevel->field2 * $waterLevel->field2 ) - ($ratio * $waterLevel->field2  * $section->vertical_distance))/2;
                    $discharge = $area * $section->coefficient * $waterLevel->field1;
                }
                elseif($section->shape==1){
                    $area = ($section->width * $waterLevel->field2 ) - ($section->width * $section->vertical_distance);
                    $discharge = $area * $section->coefficient * $waterLevel->field1;
                }
                elseif($section->shape==2){
                    if($height <= $section->triangleHeight){
                        $ratio = ($section->triangleHeight - $section->vertical_distance)* $section->width;
                        $area = (($ratio * pow($waterLevel->field2,2)) - ($ratio * $waterLevel->field2  * $section->vertical_distance))/2;
                        $discharge = $area * $section->coefficient * $waterLevel->field1;
                    }
                    elseif($height > $section->triangleHeight){
                        $area = ((0.5 * $section->$width * $section->triangleHeight) + ($waterLevel->field2 * $section->width))- ($section->triangleHeight + $section->vertical_distance);
                        $discharge = $area * $section->coefficient * $waterLevel->field1;
                    }
                }
                
                $counter = $counter + 1;
                $totalDischarge = $totalDischarge + $discharge;
                if($counter == $count){
                    Discharge::create(['dischargeValue' =>$totalDischarge,'river_id'=>$river->id]);
                    $counter = 0;
                    $totalDischarge = 0.0;
                }
            }
        }        


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
