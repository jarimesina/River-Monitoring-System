@extends('base')
@include('layouts.app')
@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="page-title">Device Locations</h1>
    @if(auth()->user()->is_admin==1)
      <div>
      <a style="margin: 19px;" href="{{ route('rivers.create')}}" class="btn btn-primary ml-0">Add New Location</a>
      </div>     
    @elseif(auth()->user()->is_admin==0)
      <div>
      </div> 
    @endif
  <table class="table table-striped">
    <thead class="font-bold">
        <tr>
          <td>River ID</td>
          <td>Location</td>
          <td>River Name</td>
          <td>Actions</td>
        </tr>
    </thead>
    <tbody>
      @foreach($rivers as $river)
        <tr>
            <td>{{$river->id}}</td>
            <td>{{$river->location}}</td>
            <td>{{$river->name}}</td>
            @if(auth()->user()->is_admin==1)
              <td>
                  <a href="{{ route('rivers.edit',$river->id)}}" class="btn btn-primary">Edit</a>
              </td>
              <td>
                  <form class="delete" action="{{ route('rivers.destroy', $river->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
              </td>
              <td>
                <button onclick="window.location='{{ url("/rivers/{$river->id}/details") }}'" class="btn btn-success" type="submit">View Properties</button>
              </td>
            @else(auth()->user()->is_admin==0)
              <td>
                <button onclick="window.location='{{ url("/rivers/{$river->id}/details") }}'" class="btn btn-success" type="submit">View Properties</button>
              </td>
            @endif
        </tr>
      @endforeach
    </tbody>
  </table>
<div>
</div>
<script>
    $(".delete").on("submit", function(){
        return confirm("Are you sure?");
    });
</script>
@endsection