@extends('layouts.app')
@section('content')
<br/>
<a href="{{ route('rivers.index')}}"class="btn btn-danger">Cancel</a>
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
      </div><br/>
    @endif
    <form method="post" action="{{ route('rivers.store') }}">
        @csrf
        <div class="form-group">    
            <label for="name">River Name:</label>
            <input type="text" class="form-control" name="name" required/>
        </div>
        <div class="form-group">
            <label for="location">Address:</label>
            <input type="text" class="form-control" name="location" required/>
        </div>
        <div class="form-group">
            <label for="key">Api key:</label>
            <input type="text" class="form-control" name="key" required/>
        </div>
        <div class="form-group">
            <label for="channel">Channel ID:</label>
            <input type="text" class="form-control" name="channel" required/>
        </div>
        <div class="form-group">
            <label for="width">Width:</label>
            <input type="text" class="form-control" name="width" required/>
        </div>
        <div class="form-group">
            <label for="height">Height:</label>
            <input type="text" class="form-control" name="height" required/>
        </div>
        <button type="text" class="btn btn-primary">Add river</button>
    </form>
  </div>
</div>
</div>
@endsection