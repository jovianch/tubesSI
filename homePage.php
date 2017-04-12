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
		//search
		$keyword = "";

		//check if search exist
		if(isset($_GET['searchKey'])) {
    		$keyword = $_GET["searchKey"];
		}

		$servername = "localhost";
		$username = "root";
		//$password = "password";
		$dbname = "tirtaanugrah";

		//connection to the database
		$dbhandle = mysqli_connect($servername, $username, NULL, $dbname)
	  		or die("Unable to connect to MySQL");
		//echo "Connected to MySQL<br>";


		//create

		//check if the page after create
		if(isset($_GET['noHP'])) {
			if ($_GET['noHP']="" || $_GET['nama']="" || )

    		//execute create
    		$query = "INSERT INTO customer VALUES ('" . $_GET['noHP'] . "','" . $_GET['nama'] . "');";
    		mysqli_query($dbhandle, $query);

    		$query = "INSERT INTO pesanan (deskripsi) VALUES ('" . $_GET['pesanan'] . "');";
    		mysqli_query($dbhandle, $query);

    		$query = "INSERT INTO custpesanan (no_hp, tanggal_terakhir) VALUES ('" . $_GET['noHP'] . "', (SELECT DATE_ADD(CURDATE(), INTERVAL 2 WEEK)));";
    		mysqli_query($dbhandle, $query);

    		//sendSMS procedure
    		$fields_string  =   "";
			$fields     =   array(
								'api_key'       =>  '65d505a1',
								'api_secret'    =>  'fdda4cf940cda526',
								'to'            =>  $_GET['noHP'],
								'from'          =>  'Tirta Anugrah',
								'text'          =>  'Yth. Sdr. ' . $_GET['nama'] . ' produk ' . $_GET['pesanan'] . ' harap segera diambil. Terimakasih.  -Tirta Anugrah-'
			);
			$url        =   'https://rest.nexmo.com/sms/json';

			//url-ify the data for the POST
			foreach($fields as $key=>$value) {   
					$fields_string .= $key.'='.$value.'&';
					}
			rtrim($fields_string, '&');

				//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, count($fields));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

			//execute post
			$result = curl_exec($ch);
			//close connection
			curl_close($ch);
		}


		//check if the page after set time
		if(isset($_GET['jam'])) {
			$query = "UPDATE time SET jam=" . $_GET['jam'] . ", menit=" . $_GET['menit'] . ", detik=" . $_GET['detik'] . ";";
			mysqli_query($dbhandle, $query);
		}

		//check if the page after delete
		if(isset($_GET['delData'])) {
			$deletedHp = $_GET['delData'];
			$query = "SELECT id FROM custpesanan WHERE no_hp='" . $deletedHp . "';";
			$id = mysqli_query($dbhandle, $query);
			$id = $id->fetch_assoc();
			$id = $id["id"];

			//execute delete
    		$query = "DELETE FROM custpesanan WHERE no_hp='" . $deletedHp . "';";
    		mysqli_query($dbhandle, $query);

    		$query = "DELETE FROM customer WHERE no_hp='" . $deletedHp . "';";
    		mysqli_query($dbhandle, $query);

    		$query = "DELETE FROM pesanan WHERE id = " . $id . ";";
    		mysqli_query($dbhandle, $query);

		}

		//check if the page after edit
		if(isset($_GET['newData'])) {
			$editedHp = $_GET['newData'];
			$query = "SELECT id FROM custpesanan WHERE no_hp='" . $editedHp . "';";
			$id = mysqli_query($dbhandle, $query);
			$id = $id->fetch_assoc();
			$id = $id["id"];

			$query = "SELECT tanggal_terakhir FROM custpesanan WHERE no_hp='" . $editedHp . "';";
			$date = mysqli_query($dbhandle, $query);
			$date = $date->fetch_assoc();
			$date = $date["tanggal_terakhir"];
			echo $date;

			//execute edit
    		$query = "DELETE FROM custpesanan WHERE no_hp='" . $editedHp . "';";
    		echo mysqli_query($dbhandle, $query);

    		$query = "UPDATE customer SET no_hp='" . $_GET['noHPNew'] . "', nama='" . $_GET['namaNew'] . "' WHERE no_hp='" . $editedHp . "';";
    		//echo $query;
    		echo mysqli_query($dbhandle, $query);

    		$query = "UPDATE pesanan SET deskripsi='" . $_GET['pesananNew'] . "' WHERE id = " . $id . ";";
    		echo mysqli_query($dbhandle, $query);

    		$query = "INSERT INTO custpesanan VALUES ('" . $_GET['noHPNew'] . "', " . $id . ", (SELECT DATE_ADD(CURDATE(), INTERVAL 2 WEEK));";
    		echo mysqli_query($dbhandle, $query);

		}


		$query = "SELECT * FROM (SELECT customer.no_hp AS hp, nama, deskripsi, tanggal_terakhir AS tanggal FROM customer, pesanan, custpesanan WHERE  customer.no_hp = custpesanan.no_hp AND pesanan.id = custpesanan.id) T WHERE hp LIKE '%" . $keyword. "%' OR nama LIKE '%" . $keyword . "%' OR deskripsi LIKE '%" . $keyword . "%';";

		$data = mysqli_query($dbhandle, $query);

		$arrayHp = array();
		//inisialisasi
		$i = 1;

	?>
		<div id="bodii2">
			<div id="bodii">
				<div id="judul">
					<h1 class="col-md-10 col-md-offset-1">Aplikasi Pengingat Pengambilan Produk</h1>
				</div>

				<div id="pencarian">
					<form action="homePage.php" method="get" class="col-md-10 col-md-offset-1 input-group">
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
					  	<th class="col-md-1 text-center">No</th>
					    <th class="col-md-1 text-center">No HP</th>
					    <th class="col-md-1 text-center">Nama</th>
					    <th class="col-md-3 text-center">Pesanan</th>
					    <th class="col-md-1 text-center">Tanggal Terakhir</th>
					  </tr>
					  <?php
					  	while ($record = $data->fetch_assoc()) :
					  		$no_hp = $record["hp"];
					  		array_push($arrayHp,$no_hp);
							$nama = $record["nama"];
							$deskripsi = $record["deskripsi"];
							$tanggal = $record["tanggal"];
					  ?>
					  <tr>
					  	<td class="col-md-1 text-center"><?php echo $i; ?></td>
					    <td class="col-md-1 text-center"><?php echo $no_hp; ?></td>
					    <td class="col-md-1 text-center"><?php echo $nama; ?></td>
					    <td class="col-md-3"><?php echo $deskripsi; ?></td>
					    <td class="col-md-1 text-center"><?php echo $tanggal; ?></td>
					  </tr>
					  <?php
					  	$i++;
					  	endwhile;
					  ?>
					</table>
				</div>


				<div id="tombol" class="col-md-10 col-md-offset-1">
					<form action="homePage.php" name="CRUD" action="" method="get">
						<h3>Edit / Delete no :</h3>
						<!--input type="text" id="nama" name="nomor" placeholder="Nama customer..." class="col-sm-9"-->
						<select name="nomor">
							<?php 
								$j = 1;
								while ($j<$i) :
									if(isset($_GET['nomor'])) {
										if ($j == $_GET['nomor'])
											echo "<option value=" . $j . " selected>" . $j . "</option>";
										else echo "<option value=" . $j . ">" . $j . "</option>";
									} else {
										echo "<option value=" . $j . ">" . $j . "</option>";
									}
									$j++;
								endwhile;
							?>
						</select>

						<br><br>

						<button id="btnCreate" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
							<i class="glyphicon glyphicon-plus"></i>
							Create
						</button>

						<button id="btnEdit"type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit" name="edit" value="on">
							<i class="glyphicon glyphicon-pencil"></i>
							Edit
						</button>

						<button id="btnTime" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalTime">
							<i class="glyphicon glyphicon-time"></i>
							Time
						</button>

						<button id="btnDelete" type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" name="delete" value="on">
							<i class="glyphicon glyphicon-trash"></i>
							Delete
						</button>
					</form>
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
								<input type="text" id="nama" name="nama" placeholder="Nama customer..." class="col-sm-9">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Pesanan</label>
								<textarea type="text" id="pesanan" name="pesanan" placeholder="Deskripsi pesanan..." rows="5" class="col-sm-9"></textarea>
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
				<form action="homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
					<?php
						$hp = $arrayHp[$_GET['nomor']-1];
						//echo "test";
						$query = "SELECT customer.no_hp AS hp, nama, deskripsi FROM customer, pesanan, custpesanan WHERE  customer.no_hp = custpesanan.no_hp AND pesanan.id = custpesanan.id AND customer.no_hp='" . $hp . "';";

						$data = mysqli_query($dbhandle, $query);

						$edit = $data->fetch_assoc();
					?>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">No HP</label>
								<input type="text" id="noHP" name="noHPNew" placeholder="08XXXXXXXXXX" class="col-sm-9" value="<?php echo $edit["hp"]; ?>">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Nama</label>
								<input type="text" id="nama" name="namaNew" placeholder="Nama customer..." class="col-sm-9" value="<?php echo $edit["nama"]; ?>">
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Pesanan</label>
								<textarea type="text" id="pesanan" name="pesananNew" placeholder="Deskripsi pesanan..." rows="5" class="col-sm-9"><?php echo $edit["deskripsi"]; ?></textarea>
							</div>
					</div>
						<div class="modal-footer">
							<?php
								echo '<button type="submit" class="btn btn-success" name="newData" value="' . $edit["hp"] . '">';
							?>Save</button>
						</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL TIME -->
	
	<div class="modal fade" id="modalTime" role="dialog">
		<div class="modal-dialog modal-sm modal-time">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Set Time</h4>
				</div>
				<form action="homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
					<?php 
						$query = "SELECT * FROM time";
						$dataTime = mysqli_query($dbhandle, $query);

						$waktu = $dataTime->fetch_assoc();
					?>
							<div class="form-horizontal form-group">
								<?php

								echo '<input type="text" id="jam" name="jam" placeholder="jam" class="col-md-2 col-md-offset-2" value="' . $waktu["jam"] . '">';
								echo '<input type="text" id="menit" name="menit" placeholder="menit" class="col-md-2 col-md-offset-1" value="' . $waktu["menit"] . '">';

								?>
							</div>
							<div class="form-horizontal form-group">
								<b class="col-sm-2 col-md-offset-2">Jam</b>
								<b class="col-sm-2 col-md-offset-1">Menit</b>
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
				<form action="homePage.php" method="get" class="form-horizontal">
					<div class="modal-body">
					<?php
						$hp = $arrayHp[$_GET['nomor']-1];
						//echo "test";
						$query = "SELECT customer.no_hp AS hp, nama, deskripsi FROM customer, pesanan, custpesanan WHERE  customer.no_hp = custpesanan.no_hp AND pesanan.id = custpesanan.id AND customer.no_hp='" . $hp . "';";

						$data = mysqli_query($dbhandle, $query);

						$delete = $data->fetch_assoc();
					?>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">No HP</label>
								<input type="text" id="noHP" name="noHPDel" placeholder="08XXXXXXXXXX" class="col-sm-9" value="<?php echo $delete["hp"]; ?>" disabled>
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Nama</label>
								<input type="text" id="nama" name="namaDel" placeholder="Nama customer..." class="col-sm-9" value="<?php echo $delete["nama"]; ?>"  disabled>
							</div>
							<div class="form-group">
								<label for="noHP" class="col-sm-2 control-label">Pesanan</label>
								<textarea type="text" id="pesanan" name="pesananDel" placeholder="Deskripsi pesanan..." rows="5" class="col-sm-9" disabled><?php echo $delete["deskripsi"]; ?></textarea>
							</div>
					</div>
						<div class="modal-footer">
							<?php
								echo '<button type="submit" class="btn btn-danger" name="delData" value="' . $delete["hp"] . '">';
							?>
							Delete</button>
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
	<!-- SCRIPT -->
	<?php
		if(isset($_GET['nomor'])) {
			if(isset($_GET['edit'])) {
	    		echo '<script type="text/javascript">';
		    	echo '$(document).ready(function(){';
		        echo "$('#modalEdit').modal('show');";
		    	echo "});	</script>";
			} else {
				echo '<script type="text/javascript">';
		    	echo '$(document).ready(function(){';
		        echo "$('#modalDelete').modal('show');";
		    	echo "});	</script>";
			}
		}
	?>
	</body>
</html>
