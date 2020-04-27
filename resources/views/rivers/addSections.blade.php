@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a river</h1>
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
        @for ($i=0;$i<$river->sections;$i++)
        <div class="form-group">    
            <label for="name">River Name:</label>
            <input type="text" class="form-control" name="name" required/>
        </div>
        @endfor

        <button type="submit" class="btn btn-primary">Add river</button>
      </form>
  </div>
</div>
</div>
@endsection