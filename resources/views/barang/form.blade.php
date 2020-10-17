<div class="form-group">
	<label>Nama</label>
	{!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'barang']) !!}
</div>
<div class="form-group">
	<label>Harga</label>
	{!! Form::text('harga', null, ['class' => 'form-control', 'id' => 'harga']) !!}
</div>
<div class="form-group">
	<table id="table-satuan" class="table table-bordered table-sm">
		<thead>
			<tr>
				<th>Satuan</th>
				<th class="text-center">X</th>
				<th class="text-center">Y</th>
				<th></th>
			</tr>
		</thead>
		<tbody>	
			@if (Form::getValueAttribute('satuan'))
				@foreach(Form::getValueAttribute('satuan') as $key => $satuan)
					<tr id="table-satuan-{!! $key !!}">
						<td>{!! Form::text('satuan['.$key.'][satuan]', null, ['class' => 'form-control form-control-sm']) !!}</td>
						<td>{!! Form::text('satuan['.$key.'][x]', null, ['class' => 'form-control form-control-sm']) !!}</td>
						<td>{!! Form::text('satuan['.$key.'][y]', null, ['class' => 'form-control form-control-sm']) !!}</td>
						<th>
							<button type="button" class="btn btn-sm btn-danger" onclick="deleteSatuan({!! $key !!})">Delete</button>
						</th>
					</tr>	
				@endforeach
			@endif
		</tbody>
	</table>
</div>
<div class="form-group text-right">
	<button type="button" class="btn btn-primary" onclick="addSatuan()">Add</button>
</div>