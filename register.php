<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<?php
include "koneksi/koneksi.php";
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
	<!--Made with love by Mutiullah Samim -->

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<style>
		/* Made with love by Mutiullah Samim*/

		@import url('https://fonts.googleapis.com/css?family=Numans');

		html,
		body {
			background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
			background-size: cover;
			background-repeat: no-repeat;
			height: 100%;
			font-family: 'Numans', sans-serif;
		}

		.container {
			height: 100%;
			align-content: center;
		}

		.card {
			height: 450px;
			margin-top: auto;
			margin-bottom: auto;
			width: 400px;
			background-color: rgba(0, 0, 0, 0.5) !important;
		}

		.social_icon span {
			font-size: 60px;
			margin-left: 10px;
			color: #FFC312;
		}

		.social_icon span:hover {
			color: white;
			cursor: pointer;
		}

		.card-header h3 {
			color: white;
		}

		.social_icon {
			position: absolute;
			right: 20px;
			top: -45px;
		}

		.input-group-prepend span {
			width: 50px;
			background-color: #FFC312;
			color: black;
			border: 0 !important;
		}

		input:focus {
			outline: 0 0 0 0 !important;
			box-shadow: 0 0 0 0 !important;

		}

		.remember {
			color: white;
		}

		.remember input {
			width: 20px;
			height: 20px;
			margin-left: 15px;
			margin-right: 5px;
		}

		.login_btn {
			color: black;
			background-color: #51ff0d;
			width: 100px;
		}

		.login_btn:hover {
			color: black;
			background-color: white;
		}

		.links {
			color: white;
		}

		.links a {
			margin-left: 4px;
		}
	</style>

</head>

<body>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header">
					<h3>PENDAFTARAN</h3>
					<div class="d-flex justify-content-end social_icon">
						<span>
							<image src="lam.png" right ></image>
						</span>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="">
					<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-file"></i></span>
							</div>
							<input type="text" class="form-control" name="nik" placeholder="Masukkan Nik">
						</div>
						
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" name="password" placeholder="Masukkan Password">
						</div> 

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-map"></i></span>
							</div>
							<input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat">
						</div>

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-phone"></i></span>
							</div>
							<input type="text" class="form-control" name="no_hp" placeholder="Masukkan NoHP">
						</div>

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-calendar"></i></span>
							</div>
							<input type="date" class="form-control" name="tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
						</div>

						<div class="form-group">
							<input type="submit" name="simpan" value="Simpan" class="btn float-right login_btn">
						</div>
					</form>
					<?php
					if (isset($_POST['simpan'])) {
						$nama = $_POST['nama'];
						$nik = $_POST['nik'];
						$alamat = $_POST['alamat'];
						$no_hp = $_POST['no_hp'];
						$tanggal_lahir = $_POST['tanggal_lahir'];
						$verifikasi=0;
						$status=1;
						$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

						// menyeleksi data admin dengan nama dan password yang sesuai
						$simpan = mysqli_query($konek, "INSERT INTO user (nama,nik,alamat, no_hp,tanggal_lahir, status, verifikasi, password) VALUES ('$nama','$nik','$alamat','$no_hp','$tanggal_lahir', '$status', '$verifikasi', '$password')");

						if ($simpan) {
							# code...
							echo "<script>alert('Data Berhasil Disimpan'); window.location.href='login.php'</script>";
						}
					}
					?>

				</div>

			</div>
		</div>
	</div>
	</div>
</body>

</html>