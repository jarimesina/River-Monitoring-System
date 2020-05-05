<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Sections;
use App\River;
use Illuminate\Support\Collection;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rivers = River::all();
        
        $array1 = array();
        $shapes = array('Triangle','Rectangle','Trapezoid');


        foreach($rivers as $river){
            array_push($array1, $river->name);
        }

        // dd($array1);
        return view('sections.create',compact('array1','shapes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = new Sections;
        $section->river_id = $request->sections;
        $section->coefficient = $request->coefficient;
        $section->width = $request->width;
        $section->shape = $request->shapes;
        $section->vertical_distance = $request->vertical_distance;
        $section->triangleHeight = $request->triangleHeight;
        $section->save();
        return redirect('/rivers')->with('success', 'Section saved!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sections = Sections::where('river_id','=',$id)->get();
        // $labels = array();
        // $dischargeArray = array();
        // $temp = River::where('id','=',$id)->first();
        // $client = new Client();

        // //query the water levels and velocities
        // $waterLevels = $client->request('GET','https://api.thingspeak.com/channels/' . $temp->channel . '/feeds.json?api_key=' . $temp->key . '&results=30');
        // $waterLevels = json_decode($waterLevels->getBody()->getContents()); 
        // $waterLevels = $waterLevels->feeds;
        // dump($waterLevels);
        // $discharge = 0.00;
        // $totalDischarge = 0.00;
        // $count = $sections->count();
        // //get height of the river
        // $width = $temp->width;
        // $height = $temp->height;
        
        // //store in an array the totaldischarge

        // $counter = 0; 

        // // for($i =0;$i<$count;$i++){

        // // }
        // foreach($waterLevels as $waterLevel){
        //     foreach ($sections as $section){
        //         if ($section->shape==1){
        //             $ratio = $section->width*($height - $section->vertical_distance);
        //             // dump($ratio);
        //             //change to height from device?
        //             // dump($waterLevel->field2);
        //             $area = (($ratio * $waterLevel->field2 * $waterLevel->field2 ) - ($ratio * $waterLevel->field2  * $section->vertical_distance))/2;
        //             dump($area);
        //             // $discharge = $area * $section->coefficient * $section->velocity;
        //             $discharge = $area * $section->coefficient * $waterLevel->field1;
        //             // dump($discharge);
        //         }
        //         elseif($section->shape==2){
        //             $area = ($section->width * $waterLevel->field2 ) - ($section->width * $section->vertical_distance);
        //             // $discharge = $area * $section->coefficient * $section->velocity;
        //             $discharge = $area * $section->coefficient * $waterLevel->field1;
        //             // dump($discharge);
        //         }
        //         elseif($section->shape==3){
        //             if($height <= $section->triangleHeight){
        //                 // $ratio = $width/$waterLevel->field2;
        //                 $ratio = $width * ($section->triangleHeight - $section->vertical_distance);
        //                 $area = (($ratio * $waterLevel->field2 * $waterLevel->field2) - ($ratio * $waterLevel->field2  * $section->vertical_distance))/2;
                        
        //                 $discharge = $area * $section->coefficient * $waterLevel->field1;
        //                 // dump($discharge);
        //             }
        //             elseif($height > $section->triangleHeight){
        //                 //change to height from device
        //                 $area = ((0.5 * $section->$width * $section->triangleHeight) + ($waterLevel->field2 * $width))- ($section->triangleHeight + $section->vertical_distance);
        //                 $discharge = $area * $section->coefficient * $waterLevel->field1;
        //                 // dump($discharge);
        //             }
        //         }
                
        //         $counter = $counter + 1;
        //         $totalDischarge = $totalDischarge + $discharge;
        //         if($counter == $count){
                    
        //             dump("HELLO");
        //             dump($totalDischarge);
        //             array_push($dischargeArray, (float)$totalDischarge);
        //             $counter = 0;
        //             $totalDischarge = 0.0;
        //         }
                
        //     }
        //     // dump("HI");
        //     array_push($labels, $waterLevel->entry_id);
        // }
        // $data = collect($dischargeArray);
        // $labels = collect($labels);
        // dump($data);
        // dd($labels);
        
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sections = Sections::find($id);
        $shapes = array('Triangle','Rectangle','Trapezoid');

        return view('sections.edit', compact('sections','shapes'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'coefficient'=>'required',
            'shapes'=>'required',
            'width'=>'required',
            'verticalDistance'=>'required',
        ]);

        //check if input is not redundant
        $section = Sections::find($id);
        $section->coefficient = $request->get('coefficient');
        $section->shapes =  $request->get('shapes');
        $section->width = $request->get('width');
        $section->vertical_distance =  $request->get('verticalDistance');
        $section->save();

        return redirect('/rivers')->with('success', 'River updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sections = Sections::find($id);
        $sections->delete();

        return redirect('/rivers')->with('success', 'Section deleted!');
    }
}
