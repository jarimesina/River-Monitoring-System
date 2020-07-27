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

        $sections = Sections::where('river_id','=',$river->id)->get();

        $count = $sections->count();
        $width = $temp->width;
        $height = $temp->height;
        $counter = 0; 
        $totalArea = 0.00;

        foreach($waterLevels as $waterLevel){
            foreach ($sections as $section){
                if ($section->shape==0){
                    $ratio = $section->width*($height - $section->y1);
                    $no = (($waterLevel->field2-$height)+ $section->y1);
                    $area = (pow($no,2) * $section->width)/(2*$section->y1);
                    $discharge = $area * $waterLevel->field1 * $section->multiplier;
                }
                elseif($section->shape==1){
                    $area = $section->width*($waterLevel->field2 - $height + $section->y1);
                    $discharge = $area * $waterLevel->field1 * $section->multiplier;
                }
                elseif($section->shape==2){
                    $ratio = $section->width*($height - $section->y2);
                    if($waterLevel->field2  <= $height - $section->y1){
                        $area =  $section->width*pow(($waterLevel->field2 - $height + $section->y2 - $section->y1),2)/($section->y2 - $section->y1);
                    }
                    elseif($waterLevel->field2 > $height - $section->y1){
                        $area = $section->width*($section->y1 + $section->y2 + (2*$waterLevel->field2)- (2*$height))/2;
                    }

                    $discharge = $area * $waterLevel->field1 * $section->multiplier;
                }
                $totalArea = $totalArea + $area; 

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
