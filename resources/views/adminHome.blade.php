@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                   
                    <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Water Level</th>
                            <th>Water Velocity</th>
                            <th>Temperature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fields as $field)
                            <tr>
                            <td >{{$field->id}}</td>
                            <td scope="row">{{$field->field1}}</td>
                            <td >{{$field->field2}}</td>
                            <td >{{$field->field3}}</td>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>

function createRiver(){
    document.getElementById('durationDiv').style.display = 'flex';
}
</script> -->
@endsection

@push('scripts')
<script>
$(document).ready( function () {

    $('.table').DataTable();
} );
</script>

@endpush