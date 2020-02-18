<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Dates;

class apiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        Dates::create(['start' =>$request->start,'end' =>$request->end]);

      
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {

        Dates::create(['start' => $request->start,'end' =>$request->end]);

        $client = new Client();
        $date = Dates::latest()->first();
        $start = explode('-', $date->start);
        $end = explode('-', $date->end);
        // dump($start);
        // dump($end);
        // dd($date);
        // dump($start[0]);
        // dump($start[1]);
        // dump($start[2]);
        // dump($end[0]);
        // dump($end[1]);
        // dump($end[2]);
        $url = 'https://api.thingspeak.com/channels/952196/fields/2.json?api_key=RGBK34NEJJV41DY7&start='.$start[0].'-'.$start[1].'-'.$start[2].'&end='.$end[0].'-'.$end[1].'-'.$end[2];
        // dump($url);
        $res2 = $client->request('GET',$url);
        $temp = json_decode($res2->getBody()->getContents()); //--original
        $temp = $temp->feeds;

        $cart = array();
        $id = array();

        foreach($temp as $element){
            array_push($cart, (float)$element->field2);
            array_push($id, $element->entry_id);
        }

        $cart2 = new Collection();
        $id2 = new Collection();
        $data = collect($cart);
        $labels = collect($id);
        //try passing a view with compact labels and data
        return response()->json(compact('labels', 'data'));
          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
