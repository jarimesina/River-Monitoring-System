@extends('base')

@section('main')
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
            <label for="velocity">Velocity:</label>
            <input type="text" class="form-control" name="velocity" required/>
        </div>

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
        <button type="submit" class="btn btn-primary">Add section</button>
    </form>
  </div>
</div>
</div>
@endsection