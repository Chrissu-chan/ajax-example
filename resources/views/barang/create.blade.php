{!! Form::open(['id' => 'frm-barang']) !!}
    @include('barang.form')
    <div class="form-group">
    	<button type="button" class="btn btn-primary" onclick="store()">Save</button>
    	<button type="button" class="btn btn-default" onclick="bootbox.hideAll()">Cancel</button>
    <div>
{!! Form::close() !!}