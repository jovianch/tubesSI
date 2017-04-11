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

				</div>

				<div id="login-panel">
					<form action="homePage.php" name = "login" method="post" class="form-group" onsubmit = "return validateForm()">
					<div class="panel panel-primary">
				  	<div class="panel-heading">Silakan Login ke Sistem</div>
				    <div class="panel-body">

										<div class="form-inline">
											<label for="username" class="col-sm-3 control-label">Username</label>
											<input type="text" id="username" name="username" placeholder="example" class="col-sm-4">
									  </div>
										<br>
										<br>
										<div class="form-group">
											<label for="password" class="col-sm-3 control-label">Password</label>
											<input type="password" id="password" name="password" placeholder="xxxxxxxxx" class="col-sm-4">
										</div>
						</div>
						<div class="panel-footer">
								<button type="submit" class="btn btn-success" id="login-button">Login</button>
						</div>
				  </div>
					</form>
				</div>
	</body>
</html>

<script>
function validateForm(){
	var username = document.forms["login"]["username"].value;
	var password = document.forms["login"]["password"].value;
	if ((username == "tirtaanugrah") && (password == "1234567890")){
		return true;
	}
	else{
		alert("username or password false");
		return false;
	}
}
</script>
