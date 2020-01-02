<?php

namespace App\Http\Controllers;

use App\River;
use Illuminate\Http\Request;

class RiverController extends Controller
{
    public function index()
    {
        $rivers = River::all();

        return view('rivers.index', compact('rivers'));
    }

    public function create()
    {
        return view('rivers.create');
    }

    public function store(Request $request)
    {
        
        $river = new River;
        $river->name = $request->name;
        $river->location = $request->location;
        $river->save();
        // return redirect('admin/home')->with('success', 'River saved!');
        return redirect('/rivers')->with('success', 'River saved!');
    }

    public function show(Request $request)
    {
        $rivers = River::all();
       
        return view('displayRiver',compact('rivers'));
    }

    public function edit($id)
    {
        $rivers = River::find($id);
        return view('rivers.edit', compact('rivers'));        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'location'=>'required'
        ]);

        $river = River::find($id);
        $river->name =  $request->get('name');
        $river->location = $request->get('location');
        $river->save();

        return redirect('/rivers')->with('success', 'River updated!');
    }

    public function destroy($id)
    {
        $river = River::find($id);
        $river->delete();

        return redirect('/rivers')->with('success', 'River deleted!');
    }

    public function details($id)
    {
        $river = River::find($id);

        return view('rivers.riverDetails',compact('river'));
    }
}
