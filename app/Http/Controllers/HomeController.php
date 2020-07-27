<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            return view('home');
        }
        else{
            echo "<h2>I should redirect you somewhere else now.</h2>";
        }
    }

    public function about()
    {
        if (auth()->check()) {
            return view('device');
        }
        else{
            return redirect('home');
        }   

    }

    public function scorpion()
    {
        if (auth()->check()) {
            return view('team');
        }
        else{
            return redirect('home');
        }   

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        if (auth()->check()) {
            return view('adminHome');
        }
        else{
            return redirect('home');
        }   

    }
}
