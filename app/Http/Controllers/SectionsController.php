<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Sections;
use App\River;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

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
    public function add($riverId)
    {
        $rivers = River::all();
        
        // $array1 = array();
        $shapes = array('Triangle','Rectangle','Trapezoid');


        // foreach($rivers as $river){
        //     array_push($array1, $river->name);
        //     array_push($array1, "butuanon");
        // }

        // dd($rivers);
        // return view('sections.create',compact('array1','shapes','riverId'));
        return view('sections.create',compact('rivers','shapes','riverId'));

    }

    // public function create()
    // {
    //     $rivers = River::all();
        
    //     $array1 = array();
    //     $shapes = array('Triangle','Rectangle','Trapezoid');


    //     foreach($rivers as $river){
    //         array_push($array1, $river->name);
    //     }

    //     // dd($array1);
    //     return view('sections.create',compact('array1','shapes'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'sections'=>'required',
            'coefficient'=>'required|between:0,1.00|numeric',
            'width'=>'required|between:0,99.99|numeric',
            'shape'=>'required',
            'vertical_distance'=>'required|between:0,99.99|numeric',
        ]);

        if ($validatedData->fails()){
            // return redirect('rivers/edit')->withErrors($validatedData)->withInput();
            return back()->withErrors($validatedData)->withInput();

        }
        else{
            $section = new Sections;
            $section->river_id = $request->sections;
            $section->coefficient = $request->coefficient;
            $section->width = $request->width;
            $section->shape = $request->shape;
            $section->vertical_distance = $request->vertical_distance;
            $section->triangleHeight = $request->triangleHeight;
            $section->save();
            return redirect('rivers')->with('success', 'Section saved!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $labels = array();
        // $dischargeArray = array();
        // $temp = River::where('id','=',$id)->first();
        // $client = new Client();

        // //query the water levels and velocities
        // $waterLevels = $client->request('GET','https://api.thingspeak.com/channels/' . $temp->channel . '/feeds.json?api_key=' . $temp->key . '&results=30');
        // $waterLevels = json_decode($waterLevels->getBody()->getContents()); 
        // $waterLevels = $waterLevels->feeds;
        // // dd($waterLevels);
        // $discharge = 0.00;
        // $totalDischarge = 0.00;
        // $sections = Sections::where('river_id','=',$id)->get();
        // $count = $sections->count();
        // $width = $temp->width;
        // $height = $temp->height;
        // $counter = 0; 

        // foreach($waterLevels as $waterLevel){
        //     foreach ($sections as $section){
        //         if ($section->shape==0){
        //             $ratio = $section->width*($height - $section->vertical_distance);
        //             // dump($ratio);
        //             //change to height from device?
        //             $area = (($ratio * $waterLevel->field2 * $waterLevel->field2 ) - ($ratio * $waterLevel->field2  * $section->vertical_distance))/2;
        //             // dump($area);
        //             // $discharge = $area * $section->coefficient * $section->velocity;
        //             $discharge = $area * $section->coefficient * $waterLevel->field1;
        //             // dd($discharge);
        //         }
        //         elseif($section->shape==1){
        //             $area = ($section->width * $waterLevel->field2 ) - ($section->width * $section->vertical_distance);
        //             // $discharge = $area * $section->coefficient * $section->velocity;
        //             $discharge = $area * $section->coefficient * $waterLevel->field1;
        //         }
        //         elseif($section->shape==2){
        //             // dump("HI");
        //             if($height <= $section->triangleHeight){
        //                 $ratio = ($section->triangleHeight - $section->vertical_distance)* $section->width;
        //                 $area = (($ratio * pow($waterLevel->field2,2)) - ($ratio * $waterLevel->field2  * $section->vertical_distance))/2;
        //                 $discharge = $area * $section->coefficient * $waterLevel->field1;
        //             }
        //             elseif($height > $section->triangleHeight){
        //                 // dump("HI");
        //                 $area = ((0.5 * $section->$width * $section->triangleHeight) + ($waterLevel->field2 * $section->width))- ($section->triangleHeight + $section->vertical_distance);
        //                 // dump($area);
        //                 $discharge = $area * $section->coefficient * $waterLevel->field1;
        //             }
        //         }
                
        //         $counter = $counter + 1;
        //         $totalDischarge = $totalDischarge + $discharge;
        //         if($counter == $count){
        //             array_push($dischargeArray, (float)$totalDischarge);
        //             $counter = 0;
        //             $totalDischarge = 0.0;
        //         }   
                
        //     }
        //     array_push($labels, $waterLevel->entry_id);
        // }
        // $data = collect($dischargeArray);
        // $labels = collect($labels);
        // -------original code---------//
        $riverId = $id;
        $sections = Sections::where('river_id','=',$id)->get();
        // -------original code---------//
        return view('sections.index', compact('sections','riverId'));
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
            'coefficient'=>'required|between:0,1.00|numeric',
            'shape'=>'required',
            'width'=>'required|between:0,99.99|numeric',
            'verticalDistance'=>'required|between:0,99.99|numeric',
        ]);

        //check if input is not redundant
        $section = Sections::find($id);
        $section->coefficient = $request->get('coefficient');
        $section->shape = $request->get('shape');
        $section->width = $request->get('width');
        $section->vertical_distance = $request->get('verticalDistance');
        $section->triangleHeight = $request->get('triangleHeight');
        $section->save();

        return redirect('/rivers')->with('success', 'Section updated!');

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

        return back()->with('success', 'Section deleted!');
    }
}
