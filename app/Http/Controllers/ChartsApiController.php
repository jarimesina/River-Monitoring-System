<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\River;
use App\Field;
use App\Http\Controllers\Controller;
use App\Speed;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ChartsApiController extends Controller
{
    public function index()
    {
        $client = new Client();
        // $res2 = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7&results=5
        // '); //--original
        // $temp = json_decode($res2->getBody()->getContents()); //--original
        // $temp=$temp->feeds;
        // $result = end($temp);
      
        // Field::create(['field1' =>$result->field1,'field2' =>$result->field2,'field3' =>$result->field3,'field4' =>$result->field4]);

        // $fields = Field::latest()->take(30)->get()->sortBy('id');
        // $labels = $fields->pluck('id');
        // $data = $fields->pluck("field2");
        
        $res2 = $client->request('GET','https://api.thingspeak.com/channels/952196/fields/2.json?api_key=RGBK34NEJJV41DY7&results=30');
        $temp2 = json_decode($res2->getBody()->getContents()); 
        $temp2=$temp2->feeds;
        // dump($temp2);

        $cart = array();
        $id = array();

        foreach($temp2 as $element){
            array_push($cart, (float)$element->field2);
            array_push($id, $element->entry_id);
        }

        // dump($cart);
        // dd($id);
        $cart2 = new Collection();
        $id2 = new Collection();
        $data = collect($cart);
        $labels = collect($id);
        // dump($cart2);
        // dd($id2);
        return response()->json(compact('labels', 'data'));
    }

    public function getDetails()
    {
        $client = new Client();
        // $fields = Field::latest()->take(30)->get()->sortBy('id');
        // $field1 = $fields->pluck("field1");
        // $field2 = $fields->pluck("field2");
        // $field3 = $fields->pluck("field3");
        // $field4 = $fields->pluck("field4");
        $res2 = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7');
        $temp = json_decode($res2->getBody()); //--original
        $temp = $temp->feeds;
        $field1 = end($temp)->field1;
        $field2 = end($temp)->field2;
        $field3 = end($temp)->field3;
        $field4 = end($temp)->field4;
        
        $cart = array();
        array_push($cart, (float)end($temp)->field1);
        array_push($cart, (float)end($temp)->field2);
        array_push($cart, (float)end($temp)->field3);
        array_push($cart, (float)end($temp)->field4);

        $cart2 = new Collection();
        $data = collect($cart);
        return response()->json(compact('data'));
        // return response()->json(compact('field1','field2','field3','field4'));
    }

    public function getFields()
    {
        $client = new Client();
        $res = $client->request('GET','https://api.thingspeak.com/channels/952196/feeds.json?api_key=RGBK34NEJJV41DY7');

        $temp = json_decode($res->getBody()->getContents()); //--original

        $temp = $temp->feeds;
        
        return response()->json(compact('temp'));
    }

    public function getFlowRate()
    {
        $client = new Client();
        $res2 = $client->request('GET','https://api.thingspeak.com/channels/952196/fields/4.json?api_key=RGBK34NEJJV41DY7&results=30');
        $temp2 = json_decode($res2->getBody()->getContents()); 
        $temp2=$temp2->feeds;
        // dump($temp2);

        $cart = array();
        $id = array();

        foreach($temp2 as $element){
            array_push($cart, (float)$element->field4);
            array_push($id, $element->entry_id);
        }

        // dump($cart);
        // dd($id);
        $cart2 = new Collection();
        $id2 = new Collection();
        $data = collect($cart);
        $labels = collect($id);
        return response()->json(compact('data','labels'));
    }

    public function getDataRange(Request $request)
    {
        $client = new Client();
        $start = explode('-', $request->start);
        $end = explode('-', $request->end);

        
        $url = 'https://api.thingspeak.com/channels/952196/fields/2.json?api_key=RGBK34NEJJV41DY7&start='.$start[0].'-'.$start[1].'-'.$start[2].'&end='.$end[0].'-'.$end[1].'-'.$end[2];
        //ibalhin nalang sa apiController.php
        //ang problem kay basin sa date na gi select 
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

        return response()->json(compact('labels', 'data'));
    }
}
