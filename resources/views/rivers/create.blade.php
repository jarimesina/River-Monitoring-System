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
      <form method="post" action="{{ route('rivers.store') }}">
          @csrf
          <div class="form-group">    
              <label for="name">River Name:</label>
              <input type="text" class="form-control" name="name" required/>
          </div>
          <div class="form-group">
              <label for="location">Location:</label>
              <input type="text" class="form-control" name="location" required/>
          </div>
          <div class="form-group">
              <label for="location">Api key:</label>
              <input type="text" class="form-control" name="key" required/>
          </div>
          <div class="form-group">
              <label for="location">Channel ID:</label>
              <input type="text" class="form-control" name="channel" required/>
          </div>
          <div class="form-group">
              <label for="location">Width:</label>
              <input type="text" class="form-control" name="width" required/>
          </div>
          <button type="submit" class="btn btn-primary">Add river</button>
      </form>
  </div>
</div>
</div>
@endsection