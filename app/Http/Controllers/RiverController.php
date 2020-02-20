<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\River;
use App\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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


        $client = new Client();
        //-----------------------------------------------//
        // $response = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7&results=5
        // '); //--original
        // $temp = json_decode($response->getBody()->getContents()); //--original
        // $temp=$temp->feeds;
        // $result = end($temp);
        // $fields = Field::latest()->take(30)->get()->sortBy('id');

        // $labels = $fields->pluck('id');
        // $data = $fields->pluck("field2");
        // dump($data);
        //-----------------------------------------------//
        //-----------------------------------------------//
        // $res2 = $client->request('GET','https://api.thingspeak.com/channels/952196/fields/2.json?api_key=RGBK34NEJJV41DY7&results=30');
        // $temp2 = json_decode($res2->getBody()->getContents()); 
        // $temp2=$temp2->feeds;
        // dump($temp2);

        // $cart = array();
        // $id = array();

        // foreach($temp2 as $element){
        //     array_push($cart, (float)$element->field2);
        //     array_push($id, $element->entry_id);
        // }

        // dump($cart);
        // dd($id);
        // $cart2 = new Collection();
        // $id2 = new Collection();
        // $cart2 = collect($cart);
        // $id2 = collect($id);
        // dump($cart2);
        // dd($id2);
        //-----------------------------------------------//
        //-----------------------------------------------//
        // $res = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7');        
        // $temp = json_decode($res->getBody()->getContents()); //--original

        // $temp = $temp->feeds;
        // dump($temp);
        //-----------------------------------------------//
        //-----------------------------------------------//
        // $res2 = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7');
        // $temp = json_decode($res2->getBody()); //--original
        // $temp = $temp->feeds;
        // dd(end($temp)->field2);
        //-----------------------------------------------//
        // $fields = Field::latest()->take(30)->get()->sortBy('id');
        // $field1 = $fields->pluck("field1");
        // $field2 = $fields->pluck("field2");
        // $field3 = $fields->pluck("field3");
        // $field4 = $fields->pluck("field4");

        // dump($field1);
        // $res2 = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7');
        // $temp = json_decode($res2->getBody()); //--original
        // $temp = $temp->feeds;
        // $field1 = end($temp)->field1;
        // $field2 = end($temp)->field2;
        // $field3 = end($temp)->field3;
        // $field4 = end($temp)->field4;
        
        // $cart = array();
        // array_push($cart, (float)end($temp)->field1);
        // array_push($cart, (float)end($temp)->field2);
        // array_push($cart, (float)end($temp)->field3);
        // array_push($cart, (float)end($temp)->field4);

        // $cart2 = new Collection();
        // $data = collect($cart);

        // dd($data);
        //-----------------------------------------------//
        return view('rivers.riverDetails',compact('river'));
    }
}
