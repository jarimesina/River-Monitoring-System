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
        if (auth()->check()) {
            $rivers = River::all();
            $shapes = array('Triangle','Rectangle','Trapezoid');
            return view('sections.create',compact('rivers','shapes','riverId'));    
        }
        else{
            return redirect('home');
        }   

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if rectangle or trapezoid then y2 must be required
        $validatedData = Validator::make($request->all(), [
            'sections'=>'required',
            'width'=>'required|between:0,99.99|numeric',
            'y1'=>'required|numeric',
            'y2'=>'required_if:shape,==,1|required_if:shape,==,2|numeric',
            'shape'=>'required',
            'multiplier'=>'numeric',
        ]);

        if ($validatedData->fails()){
            // return redirect('rivers/edit')->withErrors($validatedData)->withInput();
            return back()->withErrors($validatedData)->withInput();

        }
        else{
            $section = new Sections;
            $section->river_id = $request->sections;
            $section->width = $request->width;
            $section->y1 = $request->y1;
            $section->shape = $request->shape;
            if($request->shape == 0){
                $section->y2 = NULL;
            }
            else{
                $section->y2 = $request->y2;
            }
            $section->multiplier = $request->multiplier;
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

        if (auth()->check()) {
            $riverId = $id;
            $sections = Sections::where('river_id','=',$id)->get();
            return view('sections.index', compact('sections','riverId'));
        }
        else{
            return redirect('home');
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->check()) {
            $sections = Sections::find($id);
            $shapes = array('Triangle','Rectangle','Trapezoid');
            return view('sections.edit', compact('sections','shapes'));  
        }
        else{
            return redirect('home');
        }   
      
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
        //if rectangle or trapezoid then y2 must be required
        $request->validate([
            'width'=>'required|between:0,99.99|numeric',
            'y1'=>'required|numeric',
            'y2'=>'required_if:shape,==,1|required_if:shape,==,2|numeric',
            'shape'=>'required',
            'multiplier'=>'numeric',
        ]);

        //check if input is not redundant
        $section = Sections::find($id);
        $section->width = $request->get('width');
        $section->y1 = $request->get('y1');
        if($request->shape == 0){
            $section->y2 = NULL;
        }
        else{
            $section->y2 = $request->get('y2');
        }
        $section->shape = $request->get('shape');
        $section->multiplier = $request->get('multiplier');
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
