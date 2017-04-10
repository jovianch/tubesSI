<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<head>
		<title>Aplikasi Pengingat Pengambilan Produk</title>
	</head>
	<body>
		<div id="bodii2">
			<div id="bodii">
				<div id="judul">
					<h1 class="col-md-10 col-md-offset-1">Aplikasi Pengingat Pengambilan Produk</h1>
				</div>

				<div id="pencarian">
					<form action="/action.php" method="get" class="col-md-10 col-md-offset-1 input-group">
			  			<input type="text" name="searchKey" placeholder="Nama" class="form-control">
							<div class="input-group-btn">
	      				<button class="btn btn-default" type="submit">
	        				<i class="glyphicon glyphicon-search"></i>
									Search
	      				</button>
	    				</div>
					</form>
				</div>

				<div id="tabel">
					<table class="col-md-10 col-md-offset-1 table-hover table-responsive">
					  <tr class="bg-primary">
					    <th class="col-md-1 text-center">No HP</th>
					    <th class="col-md-1 text-center">Nama</th>
					    <th class="col-md-3 text-center">Pesanan</th>
					    <th class="col-md-1 text-center">Tanggal Terakhir</th>
					  </tr>
					  <tr>
					    <td class="col-md-1 text-center">081281217726</td>
					    <td class="col-md-1 text-center">Jovian</td>
					    <td class="col-md-3">Cetak Spanduk 5 x 5 meter warna merah untuk event Wisuda HMIF</td>
					    <td class="col-md-1 text-center">26/4/2017</td>
					  </tr>
					  <tr>
					    <td class="col-md-1 text-center">083444555666</td>
					    <td class="col-md-1 text-center">Rudy</td>
					    <td class="col-md-3">Cetak Mug 500 item warna putih wisudaan HMIF</td>
					    <td class="col-md-1 text-center">27/4/2017</td>
					  </tr>
					  <tr>
					    <td class="col-md-1 text-center">089999999999</td>
					    <td class="col-md-1 text-center">Susi</td>
					    <td class="col-md-3">Cetak poster Kesenian Budaya Sunda 400 lembar</td>
					    <td class="col-md-1 text-center">28/4/2017</td>
					  </tr>
					  <tr>
					    <td class="col-md-1 text-center">085777777777</td>
					    <td class="col-md-1 text-center">Fian</td>
					    <td class="col-md-3">Cetak baliho 2x6 meter 5 item</td>
					    <td class="col-md-1 text-center">29/4/2017</td>
					  </tr>
					  <tr>
					    <td class="col-md-1 text-center">083555444111</td>
					    <td class="col-md-1 text-center">Ari</td>
					    <td class="col-md-3">Cetak Diktat Matematika 30 eksemplar @100 lembar</td>
					    <td class="col-md-1 text-center">30/4/2017</td>
					  </tr>
					  <tr>
					    <td class="col-md-1 text-center">083999000111</td>
					    <td class="col-md-1 text-center">Chris</td>
					    <td class="col-md-3">Cetak Poster Seminar Pendidikan 300 lembar</td>
					    <td class="col-md-1 text-center">1/5/2017</td>
					  </tr>
					</table>
				</div>


				<div id="tombol" class="col-md-10 col-md-offset-1">

						<button id="btnCreate" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
							<i class="glyphicon glyphicon-plus"></i>
							Create
						</button>

						<button id="btnEdit"type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalSMS">
							<i class="glyphicon glyphicon-pencil"></i>
							Edit
						</button>

						<button id="btnTime" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalTime">
							<i class="glyphicon glyphicon-time"></i>
							Time
						</button>

						<button id="btnDelete" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
							<i class="glyphicon glyphicon-trash"></i>
							Delete
						</button>
				</div>
			</div>
		</div>

	<!-- Modal -->
	<!-- MODAL CREATE -->
	<div class="modal fade" id="modalCreate" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create New</h4>
				</div>
				<form action="homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">No HP</label>
								<input type="text" id="noHP" name="noHP" placeholder="08XXXXXXXXXX" class="col-sm-9">
						  </div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Nama</label>
								<input type="text" id="nama" name="nama" placeholder="Jovian Christianto" class="col-sm-9">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Pesanan</label>
								<textarea type="text" id="pesanan" name="pesanan" placeholder="Cetak spanduk 5x10m" rows="5" class="col-sm-9"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Save</button>
						</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL EDIT -->
	<div class="modal fade" id="modalEdit" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit</h4>
				</div>
				<form action="/homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">No HP</label>
								<input type="text" id="noHP" name="noHP" placeholder="08XXXXXXXXXX" class="col-sm-9">
						  </div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Nama</label>
								<input type="text" id="nama" name="nama" placeholder="Jovian Christianto" class="col-sm-9">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Pesanan</label>
								<textarea type="text" id="pesanan" name="pesanan" placeholder="Cetak spanduk 5x10m" rows="5" class="col-sm-9"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Save</button>
						</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL TIME -->
	<div class="modal fade" id="modalTime" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Set Time</h4>
				</div>
				<form action="/homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
							<div class="form-horizontal form-group">
								<input type="text" id="jam" name="jam" placeholder="XX" class="col-md-2 col-md-offset-2">
								<input type="text" id="menit" name="menit" placeholder="XX" class="col-md-2 col-md-offset-1">
								<input type="text" id="detik" name="detik" placeholder="XX" class="col-md-2 col-md-offset-1">
							</div>
							<div class="form-horizontal form-group">
								<b class="col-sm-2 col-md-offset-2">Jam</b>
								<b class="col-sm-2 col-md-offset-1">Menit</b>
								<b class="col-sm-2 col-md-offset-1">Detik</b>
							</div>
						</div>
						<div class="modal-footer">
								<button type="submit" class="btn btn-success">Save</button>
						</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL DELETE -->
	<div class="modal fade" id="modalDelete" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<form action="/homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">No HP</label>
								<input type="text" id="noHP" name="noHP" placeholder="08XXXXXXXXXX" class="col-sm-9">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Nama</label>
								<input type="text" id="nama" name="nama" placeholder="Jovian Christianto" class="col-sm-9">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Pesanan</label>
								<textarea type="text" id="pesanan" name="pesanan" placeholder="Cetak spanduk 5x10m" rows="5" class="col-sm-9"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL PENGIRIMAN SMS -->
	<div class="modal fade" id="modalSMS" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pengiriman SMS</h4>
				</div>
				<form action="homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
							<div class="form-group">
								<label for="kepada" class="col-sm-2 control-label">Kepada</label>
								<input type="text" id="kepada" name="kepada" placeholder="" class="col-sm-9">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Konten</label>
								<textarea type="text" id="pesanan" name="pesanan" placeholder="" rows="5" class="col-sm-9"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Done</button>
						</div>
				</form>
			</div>
		</div>
	</div>

	</body>
</html>
