@extends('layouts.app')

@section('content')
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
            <!-- <input type="text" class="form-control" name="sections" required/> -->
            <select id = "riverList" name="sections">
                
                @for($i = 0; $i<count($array1); $i++)
                    <option name="sections" value = "{{$i + 1}}" required>{{$array1[$i]}}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="coefficient">Coefficient:</label>
            <input type="text" class="form-control" name="coefficient" required/>
        </div>

        <div class="form-group">    
            <label for="width">Width:</label>
            <input type="text" class="form-control" name="width" required/>
        </div>

        <div class="form-group">    
            <label for="shape">Shape:</label>
            <select id = "shapeList" name="shapes">
                
                @for($i = 0; $i<count($shapes); $i++)
                    <option name="shapes" value = "{{$i + 1}}" required>{{$shapes[$i]}}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">    
            <label for="vertical">Vertical Distance:</label>
            <input type="text" class="form-control" name="vertical_distance" required/>
        </div>

        <div class="form-group">    
            <label for="triangleHeight">If Trapezoid, please input Triangle Height:</label>
            <input type="hidden" class="form-control" name="triangleHeight" value='null'/>
            <input type="text" class="form-control" name="triangleHeight"/>
        </div>
        <button type="submit" class="btn btn-primary">Add section</button>
    </form>
  </div>
</div>
</div>
@endsection