@extends('base') 
@section('main')
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
          
                <label for="id">Section Name:</label>
                <input type="text" class="form-control" name="name" value={{ $sections->id }} />
            </div>

            <div class="form-group">
                <label for="width">Width:</label>
                <input type="text" class="form-control" name="width" value={{ $sections->width }} />
            </div>

            <div class="form-group">
                <label for="coefficient">Coefficient:</label>
                <input type="text" class="form-control" name="coefficient" value={{ $sections->coefficient }} />
            </div>

            <div class="form-group">
                <label for="verticalDistance">Vertical Distance:</label>
                <input type="text" class="form-control" name="verticalDistance" value={{ $sections->vertical_distance }} />
            </div>

            <div class="form-group">
                <label for="shapes">Shapes:</label>
                <select id = "shapeList" name="shapes">
                    @for($i = 0; $i<count($shapes); $i++)
                        <option name="shapes" value = "{{ $sections->shape }}" required>
                        {{$shapes[$i]}}
                        </option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection