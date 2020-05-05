@extends('base')
@include('layouts.app')
@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="page-title">Sections</h1> 
    
    @if(auth()->user()->is_admin==1)
      <div>
      <a style="margin: 19px;" href="{{ route('sections.create')}}" class="btn btn-primary ml-0">Add New Section</a>
      </div>     
    @else
      <div>
      </div> 
    @endif
  <table class="table table-striped">
    <thead class="font-bold">
        <tr>
          <td>Section ID</td>
          <td>Velocity</td>
          <td>Coefficient</td>
          <td>Shape</td>
          <td>Width</td>
          <td>River</td>
          <td>Vertical Distance</td>
          <td>Actions</td>
        </tr>
    </thead>
    <tbody>
      @foreach($sections as $section)
        <tr>
            <td>{{$section->id}}</td>
            <td>{{$section->velocity}}</td>
            <td>{{$section->coefficient}}</td>
            @if($section->shape == 1)
            <td>Triangle</td>
            @elseif($section->shape == 2)
            <td>Rectangle</td>
            @elseif($section->shape == 3)
            <td>Trapezoid</td>
            @endif
            <td>{{$section->width}}</td>
            <td>{{$section->river->name}}</td>
            <td>{{$section->vertical_distance}}</td>
            <td>
              <a href="{{ route('sections.edit',$section->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
              <form class="delete" action="{{ route('sections.destroy', $section->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
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