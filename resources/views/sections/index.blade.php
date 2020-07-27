@extends('layouts.app')
@section('content')
<a href="{{ url()->previous() }}">Back</a>
<div class="row" id="row1">
<div class="col-sm-12">
    <h1 class="page-title">Sections</h1> 
    
    @if(auth()->user()->is_admin==1)
      <div>
      <a style="margin: 19px;" href="{{ route('sections.add',$riverId)}}" class="btn btn-primary ml-0">Add New Section</a>
      </div>     
    @else
      <div>
      </div> 
    @endif
  <table class="table table-striped">
    <thead class="font-bold">
        <tr>
          <td>Section ID</td>
          <td>Width (m)</td>
          <td>y1 (m)</td>
          <td>y2 (m)</td>
          <td>Shape</td>
          <td>Multiplier</td>
          <td>River</td>
          <td>Actions</td>
        </tr>
    </thead>
    <tbody>
      @foreach($sections as $section)
        <tr>
            <td>{{$section->id}}</td>
            <td>{{$section->width}}</td>
            <td>{{$section->y1}}</td>
            <td>{{$section->y2}}</td>
            @if($section->shape == 0)
            <td>Triangle</td>
            @elseif($section->shape == 1)
            <td>Rectangle</td>
            @elseif($section->shape == 2)
            <td>Trapezoid</td>
            @endif
            <td>{{$section->multiplier}}</td>
            <td>{{$section->river->name}}</td>
            <td>
              <a id ="editBtn" href="{{ route('sections.edit',$section->id)}}" class="btn">Edit</a>
            </td>
            <td>
              <form class="delete" action="{{ route('sections.destroy', $section->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button id ="dltBtn" class="btn btn-danger" type="submit">Delete</button>
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