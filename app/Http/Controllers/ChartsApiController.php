<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\River;
use App\Field;
use App\Http\Controllers\Controller;
use App\Speed;

class ChartsApiController extends Controller
{
    public function index()
    {
        // Speed::create(['speed' => rand(30,70)]);

        // $speeds = Speed::latest()->take(30)->get()->sortBy('id');
        // $labels = $speeds->pluck('id');
        // $data = $speeds->pluck('speed');

        $client = new Client();
        $res = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7&results=5
        ');
        $temp = json_decode($res->getBody()->getContents());
        $temp=$temp->feeds;
        $result = end($temp);
        Field::create(['field1' =>$result->field1,'field2' =>$result->field2,'field3' =>$result->field3,'field4' =>$result->field4]);

        $fields = Field::latest()->take(30)->get()->sortBy('id');
        $labels = $fields->pluck('id');
        $data = $fields->pluck("field4");

        return response()->json(compact('labels', 'data'));
    }

    public function getDetails()
    {
        $client = new Client();
        $res = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7&results=5
        ');

        // $temp = json_decode($res->getBody()->getContents());
        $fields = Field::latest()->take(30)->get()->sortBy('id');
        $field1 = $fields->pluck("field1");
        $field2 = $fields->pluck("field2");
        $field3 = $fields->pluck("field3");
        $field4 = $fields->pluck("field4");
        // $data = end($data);
        // dd($data);
        // return json_encode(compact('field1','field2','field2','field4'));
        return response()->json(compact('field1', 'field2','field3','field4'));
    }

}
