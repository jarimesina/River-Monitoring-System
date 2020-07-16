@extends('layouts.app')
@section('content')
<a href="{{ URL::route('rivers.index') }}">Back</a>
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a Section</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <form method="post" action="{{ route('sections.store') }}">
        @csrf

        <div class="form-group">
            <label for="sections">River:</label>
            @foreach($rivers as $river)
                @if($river->id==$riverId)
                    <input type="hidden" name="sections" value="{{$riverId}}"/>
                    <input type="text" class="form-control" name="sections" placeholder= "{{$river->name}}" disabled/>
                @endif
            @endforeach
        </div>

        <div class="form-group">
            <label for="coefficient">Coefficient(If rectangle, then no need to input):</label>
            <input type="text" class="form-control" name="coefficient" required/>
        </div>

        <div class="form-group">    
            <label for="width">Width (m):</label>
            <input type="text" class="form-control" name="width" required/>
        </div>

        <div class="form-group">    
            <label for="shape">Shape:</label>
            <select id = "shapeList" name="shape">
                
                @for($i = 0; $i<count($shapes); $i++)
                    <option name="shape" value = "{{$i}}" required>{{$shapes[$i]}}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">    
            <label for="vertical">Vertical Distance (m):</label>
            <input type="text" class="form-control" name="vertical_distance" required/>
        </div>

        <div class="form-group">    
            <label for="triangleHeight">If Trapezoid, please input Triangle Height (m):</label>
            <input type="hidden" class="form-control" name="triangleHeight" value='null'/>
            <input type="text" class="form-control" name="triangleHeight"/>
        </div>
        <button type="submit" class="btn btn-primary">Add section</button>
    </form>
  </div>
</div>
</div>
@endsection