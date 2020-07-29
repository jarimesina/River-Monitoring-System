@extends('layouts.app') 
@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<br/>
<a href="{{ route('sections.show',['section' => $sections->river->id])}}" class="btn btn-danger">Cancel</a>
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
                <label for="y1">y1 (m):</label>
                <input type="text" class="form-control" name="y1" value="{{ $sections->y1 }}" required/>
            </div>

            <div class="form-group">
                <label for="shapes">Shapes:</label>
                <br>
                <!-- <input type="hidden" class="form-control" name="shape" value="{{ $sections->shape }}"/>
                <input type="radio" id="triangle" name="shape" value="0">
                <label for="shapes">Triangle</label><br>
                <input type="radio" id="rectangle" name="shape" value="1">
                <label for="shapes">Rectangle</label><br>
                <input type="radio" id="trapezoid" name="shape" value="2">
                <label for="shapes">Trapezoid</label> -->

                <select id = "shapeList" class="form-control" name="shape" id="shape">
                    <option value="0" {{ $sections->shape=="0" ? 'selected' : ''  }}>Triangle</option>
                    <option value="1"  {{ $sections->shape=="1" ? 'selected' : ''  }}>Rectangle</option>
                    <option value="2"  {{ $sections->shape=="2" ? 'selected' : ''  }}>Trapezoid</option>
                </select>
            </div>

            @if($sections->y2 == null)
                <div id="y2" class="form-group" style="display:none;">
                    <label for="y2">y2 (m):</label>
                    <input type="hidden" class="form-control" name="y2"/>
                    <input type="text" class="form-control" name="y2" value="{{ $sections->y2 }}" />
                </div>
            @else
                <div id="y2" class="form-group">
                    <label for="y2">y2 (m):</label>
                    <input type="text" class="form-control" name="y2" value="{{ $sections->y2 }}" required/>
                </div>
            @endif
            
            <div class="form-group">    
                <label for="multiplier">Multiplier:</label>
                <input type="text" class="form-control" name="multiplier" value = "{{ $sections->multiplier }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
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