@extends('layouts.app')
@section('content')
<body class="bod2">
<div class="container cont">
<div class="row">
<h1 class="page-title font-bold mt-3">About the Device</h1> 
    <div class="text-center wht">
        <p class="devicename text-left">Water Level Meter</p>
        <p class="para text-justify px-4 pt-3"> 
        The device collects the water level data by comparing the pressure outside the tube and the 
        pressure inside the tube. The pressure sensors are connected to the Arduino. As the water 
        level rises, the pressure inside the tube also rises. Every minute, the Arduino collects 
        the current data needed and sends them in SMS format by the GSM module to the base station module.</p>
        <div class="pictray d-lg-inline-flex justify-content-around">
            <img class="pic" src="{{asset('/images/wl2.png')}}">
            <img class="pic" src="{{asset('/images/wl1.png')}}">
        </div>
        <p class="devicename text-left mt-3">Water Velocity Meter</p>
        <p class="para text-justify px-4 pt-3">
        The water velocity meter uses a rotary encoder to count the rpm of the propeller. 
        The system rotates through magnetism, to make the device waterproof. As the propeller spins, 
        the encoder shaft also spins giving us a 1:1 ratio. The rotary encoder is connected to the Arduino. </p>
        <div class="pictray d-lg-inline-flex justify-content-around">        
            <img class="pic" src="{{asset('/images/wv1.png')}}">       
            <img class="pic" src="{{asset('/images/wv2.png')}}">
        </div>
    </div>
</div>
</div>
<div class="credits">
    Background Photo by <a href="https://unsplash.com/@paulberthelon">Paul Berthelon Bravo</a>
</div>
</body>
@endsection
