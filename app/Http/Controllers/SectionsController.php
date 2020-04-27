<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sections;
use App\River;

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

        foreach($rivers as $river){
            array_push($array1, $river->name);
        }

        // dd($array1);
        return view('sections.create',compact('array1'));
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
        $section->velocity = $request->velocity;
        $section->river_id = $request->sections;
        $section->coefficient = $request->coefficient;
        $section->width = $request->width;
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
        $sections = Sections::all();

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
        return view('sections.edit', compact('sections'));        
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
            'velocity'=>'required',
            'coefficient'=>'required',
        ]);

        //check if input is not redundant
        $section = Sections::find($id);
        $section->velocity =  $request->get('velocity');
        $section->coefficient = $request->get('coefficient');
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
