@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are Admin.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

function createRiver(){
    document.getElementById('durationDiv').style.display = 'flex';
}
</script>
@endsection