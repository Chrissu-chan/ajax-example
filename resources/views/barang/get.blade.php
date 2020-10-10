@foreach($model as $row)
	<tr>
		<th>{!! $row->id !!}</th>
		<th>{!! $row->nama !!}</th>
		<th>{!! $row->harga !!}</th>
		<th>
			 <a href="javascript:void(0)" onclick="edit(<?= $row->id ?>)">Edit</a>	| <a href="javascript:void(0)" onclick="destroy(<?= $row->id ?>)">Delete</a>				
		</th>
	</tr>
@endforeach