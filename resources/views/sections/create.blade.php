@extends('layouts.app')
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
            <label for="width">Width (m):</label>
            <input type="text" class="form-control" name="width" required/>
        </div>

        <div class="form-group">
            <label for="y1">y1 (m):</label>
            <input type="text" class="form-control" name="y1" required/>
        </div>

        <div class="form-group">    
            <label for="shape">Shape:</label>
            <select id = "shapeList" name="shape">
                @for($i = 0; $i<count($shapes); $i++)
                    <option value = "{{$i}}" required>{{$shapes[$i]}}</option>
                @endfor
            </select>
        </div>

        <div id="y2" class="form-group" style="display:none;">    
            <label for="y2">y2 (m):</label>
            <input type="hidden" class="form-control" name="y2" value='null'/>
            <input type="text" class="form-control" name="y2"/>
        </div>

        <div class="form-group">    
            <label for="multiplier">Multiplier:</label>
            <input type="text" class="form-control" name="multiplier" required/>
        </div>
        <button type="submit" class="btn btn-primary">Add section</button>
    </form>
  </div>
</div>
</div>
<script>
    $('#shapeList').on('change',function(){
        var selection = $(this).val();
        switch(selection){
            case "1":
                $("#y2").show()
                break;
            case "2":
                $("#y2").show()
                break;
            default:
                $("#y2").hide()
        }
    });
</script>
@endsection