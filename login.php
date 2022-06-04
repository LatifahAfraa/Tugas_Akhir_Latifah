<?php
// mengaktifkan session php
session_start();
?>
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
			height: 370px;
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




		.login_btn {
			color: black;
			background-color: #FFC312;
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
					<h3>Sign In</h3>
					<div class="d-flex justify-content-end social_icon">
						<span>
							<image src="lam.png"></image>
						</span>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" name="nama" placeholder="Nama">
						</div>

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>


						<div class="form-group">
							<input type="submit" name="submit" value="Login" class="btn float-right login_btn">
						</div>
					</form>
					<?php
					if (isset($_POST['submit'])) {
						$nama = $_POST['nama'];
						$password = $_POST['password'];

						// menyeleksi data admin dengan nama dan password yang sesuai
						$data = mysqli_query($konek, "select * from user where nama='$nama'");

						// menghitung jumlah data yang ditemukan
						$cek = mysqli_num_rows($data);

						if ($cek > 0) {
							$fetch = mysqli_fetch_assoc($data);

							// var_dump($password);
							// var_dump($fetch);
							// die();
							if (!password_verify($password, $fetch['password'])) {
								echo "<script>alert('Password anda salah');</script>"; //jika password yang verifikasi false (salah) maka tampil Password anda salah jika tidak maka login berhasil

							} else if ($fetch['verifikasi'] == 0) {
								echo "<script>alert('Anda belum diverifikasi');</script>";
							} else if ($fetch['status'] == 0) {
								echo "<script>alert('Kartu Dinonaktifkan');</script>";
							} else {
								$_SESSION['nama'] = $nama;
								$_SESSION['status'] = "login";
								echo "<script>window.location='admin/index.php'</script>";
							}
						} else {
							echo "<script>alert('Nama Tidak Ditemukan');</script>";
						}
					}
					?>

				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						Belum Punya Akun?<i><a href="register.php">Daftar Sekarang</a></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>