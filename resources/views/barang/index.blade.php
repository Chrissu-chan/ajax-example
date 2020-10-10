<html>
	<head>
		<title>Test</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">		
	</head>
	<body>
		<h1>Data Barang</h1>
		<a href="javascript:void(0)" onclick="create()">Tambah Barang</a>
		<table id="table" class="table">
			<thead>
				<tr>
					<th>id</th>
					<th>barang</th>
					<th>harga</th>
					<th></th>
				</tr>
			</thead>
			<tbody>				
			</tbody>
		</table>		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.1/bootbox.min.js"></script>
		<script type="text/javascript">
			$(function() {
				get();
			});
			function get() {
				$.ajax({
					url: '<?= route('barang.get') ?>',					
					success: function(response) {
						$('#table tbody').html(response);
					}
				})
			}

			function create() {
				$.ajax({
					url: '<?= route('barang.create') ?>',					
					success: function(response) {
						bootbox.dialog({
							title: 'Create Barang',
							message: response
						});
					}
				})				
			}

			function store() {
				$('#frm-barang .alert').remove();
				$.ajax({
					url: '<?= route('barang.store') ?>',
					type: 'post',		
					dataType: 'json',
					data: $('#frm-barang').serialize(),			
					success: function(response) {
						if (response.success) {
							alert(response.message);
							bootbox.hideAll();
							get();					
						} else {
							alert(response.message);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						var response = JSON.parse(xhr.responseText)							
						$('#frm-barang').prepend(validationMessage(response));
					}
				})	
			}

			function edit(id) {
				$.ajax({
					url: '<?= route('barang.edit') ?>/'+id,					
					success: function(response) {
						bootbox.dialog({
							title: 'Edit Barang',
							message: response
						});
					}
				})				
			}

			function update(id) {
				$('#frm-barang .alert').remove();
				$.ajax({
					url: '<?= route('barang.update') ?>/'+id,
					type: 'post',		
					dataType: 'json',
					data: $('#frm-barang').serialize(),			
					success: function(response) {
						if (response.success) {
							alert(response.message);
							bootbox.hideAll();
							get();					
						} else {
							alert(response.message);
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						var response = JSON.parse(xhr.responseText)							
						$('#frm-barang').prepend(validationMessage(response));
					}
				})	
			}

			function destroy(id) {
				$.ajax({
					url: '<?= route('barang.delete') ?>/'+id,
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							alert(response.message);
							get();							
						} else {
							alert(response.message);
						}
					}
				})
			}

			function validationMessage(errors) {
				var validationHtml = '<div class="alert alert-danger">';
					validationHtml += '<p><b>'+errors.message+'</b></p>';				
					$.each(errors.errors, function(i, error) {
						validationHtml += error[0]+'<br>'
					})							
				validationHtml += '</div>';	
				return validationHtml;
			}
		</script>
	</body>
</html>