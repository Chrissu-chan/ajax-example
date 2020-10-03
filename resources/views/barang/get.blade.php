@foreach($model as $row)
	<tr>
		<th>{!! $row->id !!}</th>
		<th>{!! $row->barang !!}</th>
		<th>{!! $row->harga !!}</th>
		<th>
			Edit | <a href="javascript:void(0)" onclick="destroy(<?= $row->id ?>)">Delete</a>						
		</th>
	</tr>
@endforeach