@extends('layouts.app')
   
@section('content')
<style>
  body{
    background-image: url("/images/river.jpg");
  }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <p class="content">
                        Welcome to the Home Page! This web application was created in partial fulfillment of the requirements of CpE 521N Research Project of 5th year Computer Engineering students of the University of San Carlos. 
                        This tracks the discharge of a river that is recorded in our system along with other parameters such as water level, velocity and temperature.
                        <mark>Head over to the locations page to see other features.</mark>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
