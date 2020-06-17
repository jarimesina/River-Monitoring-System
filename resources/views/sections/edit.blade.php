@extends('layouts.app') 
@section('content')
<a href="{{ route('rivers.index')}}">Back</a>
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a section</h1>
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        
        <form method="post" action="{{ route('sections.update', $sections->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">
          
                <label for="id">Section Id:</label>
                <input type="text" class="form-control" name="name" value="{{ $sections->id }}" disabled/>
            </div>

            <div class="form-group">
                <label for="width">Width (m):</label>
                <input type="text" class="form-control" name="width" value="{{ $sections->width }}" required/>
            </div>

            <div class="form-group">
                <label for="coefficient">Coefficient:</label>
                <input type="text" class="form-control" name="coefficient" value="{{ $sections->coefficient }}" required/>
            </div>

            <div class="form-group">
                <label for="verticalDistance">Vertical Distance (m):</label>
                <input type="text" class="form-control" name="verticalDistance" value="{{ $sections->vertical_distance }}" required/>
            </div>

            <div class="form-group">
                <label for="shapes">Shapes:</label>
                <br>
                <input type="hidden" class="form-control" name="shape" value="{{ $sections->shape }}"/>
                <input type="radio" id="triangle" name="shape" value="0">
                <label for="shapes">triangle</label><br>
                <input type="radio" id="rectangle" name="shape" value="1">
                <label for="shapes">rectangle</label><br>
                <input type="radio" id="trapezoid" name="shape" value="2">
                <label for="shapes">trapezoid</label>
            </div>

            <div class="form-group">    
                <label for="triangleHeight">If Trapezoid, please input Triangle Height (m):</label>
                <input type="hidden" class="form-control" name="triangleHeight"/>
                <input type="text" class="form-control" name="triangleHeight" value = "{{ $sections->triangleHeight }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection