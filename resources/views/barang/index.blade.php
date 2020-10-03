<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		<h1>Data Barang</h1>
		<a href="#">Tambah Barang</a>
		<table id="table" border="1" width="100%">
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
		</script>
	</body>
</html>