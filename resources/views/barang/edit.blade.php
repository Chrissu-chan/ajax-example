{!! Form::model($model, ['id' => 'frm-barang']) !!}
    @include('barang.form')
    <div class="form-group">
    	<button type="button" class="btn btn-primary" onclick="update('{!! $model->id !!}')">Update</button>
    	<button type="button" class="btn btn-default" onclick="bootbox.hideAll()">Cancel</button>
    <div>
{!! Form::close() !!}