@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($rivers as $river)
            <div class="row">
                <h1><a href="#">Name of River:{{$river->name}}</a></h1>
                <h2>Location of River:{{$river->location}}</h2>
            </div>
        @endforeach

    </div>
</div>
<a href="{{ URL::previous() }}">Go Back</a>
@endsection