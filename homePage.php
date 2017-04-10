<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<head>
		<title>Aplikasi Pengingat Pengambilan Produk</title>
	</head>
	<body>
	<?php 

		$servername = "localhost";
		$username = "root";
		//$password = "password";
		$dbname = "tirtaanugrah";

		//connection to the database
		$dbhandle = mysqli_connect($servername, $username, NULL, $dbname) 
	  		or die("Unable to connect to MySQL");
		//echo "Connected to MySQL<br>";

		$query = "SELECT customer.no_hp, nama, deskripsi, tanggal_terakhir FROM customer, pesanan, custpesanan WHERE  customer.no_hp = custpesanan.no_hp AND pesanan.id = custpesanan.id;";

		$data = mysqli_query($dbhandle, $query);

	?>
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
					  <?php
					  	while ($record = $data->fetch_assoc()) :
					  		$no_hp = $record["no_hp"];
							$nama = $record["nama"];
							$deskripsi = $record["deskripsi"];
							$tanggal = $record["tanggal_terakhir"];
					  ?>
					  <tr>
					    <td class="col-md-1 text-center"><?php echo $no_hp; ?></td>
					    <td class="col-md-1 text-center"><?php echo $nama; ?></td>
					    <td class="col-md-3"><?php echo $deskripsi; ?></td>
					    <td class="col-md-1 text-center"><?php echo $tanggal; ?></td>
					  </tr>
					  <?php endwhile; ?>
					</table>
				</div>


				<div id="tombol" class="col-md-10 col-md-offset-1">

						<button id="btnCreate" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
							<i class="glyphicon glyphicon-plus"></i>
							Create
						</button>

						<button id="btnEdit"type="button" class="btn btn-warning">
							<i class="glyphicon glyphicon-pencil"></i>
							Edit
						</button>

						<button id="btnTime" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalTime">
							<i class="glyphicon glyphicon-time"></i>
							Time
						</button>

					<a href="edit.html">
						<button id="btnDelete" type="button" class="btn btn-danger">
							<i class="glyphicon glyphicon-trash"></i>
							Delete
						</button>
					</a>
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


	</body>
</html>
