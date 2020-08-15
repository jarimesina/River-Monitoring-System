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

        //stores waterlevel and etc. into database when new data is uploaded into thingspeak every min.
        if($data[1]<=$river->height){
            WaterLevel::create([
                'entry_id' => '1',
                'level'       => trim(preg_replace('/\s+/', ' ', $data[1])),
                'temperature' => trim(preg_replace('/\s+/', ' ', $data[2])),
                'velocity'   => trim(preg_replace('/\s+/', ' ', $data[0])),
                'date_taken' => $data[3],
                'river_id'   => $river->id
            ]);


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
                    //triangle
                    if ($section->shape==0){
                        //compute if max Height - longer side < instantaneous height then compute area else return 0
                        if($height - $section->y1 < $waterLevel->field2){
                            $no = (($waterLevel->field2-$height)+ $section->y1);
                            $area = (pow($no,2) * $section->width)/(2*$section->y1);
                            $discharge = $area * $waterLevel->field1 * $section->multiplier;
                        }
                        else{
                            $area = 0;
                            $discharge = 0;
                        }

                    }
                    //rectangle
                    elseif($section->shape==1){
                        if($height - $section->y1 < $waterLevel->field2){
                            $area = $section->width*($waterLevel->field2 - $height + $section->y1);
                            $discharge = $area * $waterLevel->field1 * $section->multiplier;
                        }
                        else{
                            $area = 0;
                            $discharge = 0;
                        }
                    }
                    //trapezoids
                    elseif($section->shape==2){
                        $smallerSide = min($section->y1,$section->y2);
                        $greaterSide = max($section->y1,$section->y2);

                        $difference = $height - $greaterSide;

                        if(floatVal($waterLevel->field2) > $difference && ($waterLevel->field2)<= $height){
                            if($waterLevel->field2  <= $height - $smallerSide){
                                $no = (($waterLevel->field2-$height)+ $greaterSide);
                                $area = (pow($no,2) * $section->width)/(2*($greaterSide-$smallerSide));
                            }
                            elseif($waterLevel->field2 > $height - $smallerSide){
                                $area = (($section->width*($greaterSide-$smallerSide))/2)+($section->width*(($waterLevel->field2)+$smallerSide-$height));
                            }
    
                            $discharge = $area * $waterLevel->field1 * $section->multiplier;
                        }
                        else{
                            $area = 0;
                            $discharge = 0;
                        }
                    }
                    $totalArea = $totalArea + $area; 

                    $counter = $counter + 1;
                    $totalDischarge = $totalDischarge + $discharge;
                    
                    if($counter == $count){
                        Discharge::create(['dischargeValue' =>$totalDischarge,'river_id'=>$river->id]);
                        $counter = 0;
                        $totalDischarge = 0;
                    }
                }
            }       
        }
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
