<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class apiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $client = new Client();
        $start = explode('-', $request->start);
        $end = explode('-', $request->end);
        // dump($end);
        // $url = 'https://api.thingspeak.com/channels/952196/fields/2.json?api_key=RGBK34NEJJV41DY7&start='.$start[0].'-'.$start[2].'-'.$start[1].'&end=2020-02-07';

        $url = 'https://api.thingspeak.com/channels/952196/fields/2.json?api_key=RGBK34NEJJV41DY7&start='.$start[0].'-'.$start[2].'-'.$start[1].'&end='.$end[0].'-'.$end[2].'-'.$end[1];
        // dump($url);
        $res2 = $client->request('GET',$url);
        // dump($res2->getBody());
        $temp = json_decode($res2->getBody()->getContents()); //--original
        $temp = $temp->feeds;
        // dd($temp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
