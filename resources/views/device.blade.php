@extends('layouts.app')
@include('base')
   
@section('content')
<div class="container">
<div class="row">
<div class="col-sm-12">
<h1 class="page-title mt-3">About the Device</h1> 
    <div class="cont text-center mx-3 mt-3">
        <p class="devicename text-left">Water Level Meter</p>
        <p class="para text-justify">This water level meter was designed using the concept of Boyle's Law. 
            A barometric pressure sensor is attached to a 2-inch diameter pipe with an opening facing downward. 
            Temperature and pressure sensors are attached inside and outside the pipe. 
            These parameters are used to calculate for the water level. 
            Data is sent from the Arduino in the site to the Raspberry pi in the base station using GSM module.</p>
        <div class="pictray d-lg-inline-flex justify-content-around">
            <img src="https://66.media.tumblr.com/9c64137d33c6919e52f7b3886271ea5b/tumblr_nodjxfdcDg1shl98bo2_1280.png">
            <img src="https://66.media.tumblr.com/9c64137d33c6919e52f7b3886271ea5b/tumblr_nodjxfdcDg1shl98bo2_1280.png">
        </div>
        <p class="devicename text-left mt-5">Water Velocity Meter</p>
        <p class="para text-justify">A propeller is attached to (an encoder?). When spinning, the propeller will output electrical voltage. This voltage will determine the speed of the propeller's turn. It will be connected to the Microcontroller Unit (MCU) and will enable the MCU to record its current speed. The water velocity of the river passing through the turbine is directly proportional to the velocity of the turbine. </p>
        <div class="pictray d-lg-inline-flex justify-content-around">
            <img src="https://66.media.tumblr.com/9c64137d33c6919e52f7b3886271ea5b/tumblr_nodjxfdcDg1shl98bo2_1280.png">
            <img src="https://66.media.tumblr.com/9c64137d33c6919e52f7b3886271ea5b/tumblr_nodjxfdcDg1shl98bo2_1280.png">
        </div>
    </div>
</div>
</div>
</div>
@endsection
