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

<!-- Modal HTML Markup -->
<!-- <div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Input River Details</h1>
            </div>
            <div class="modal-body">
                <form action="river/store" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label class="control-label" >River Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="riverName" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Location</label>
                        <div>
                            <input class="form-control input-lg" name="location" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success">
                                Add River
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

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