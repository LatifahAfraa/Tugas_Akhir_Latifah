<?php
$data = mysqli_query($konek, "SELECT * FROM user WHERE id_user ='$_GET[id_user]'");
$user = mysqli_fetch_assoc($data);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mengaktifkan Atau Menonaktifkan E-KTP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Mengaktifkan Atau Menonaktifkan E-KTP</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <center>
                                <h2>Mengaktifkan Atau Menonaktifkan E-KTP</h2>
                            </center>
                            <form action="" method="POST">
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-2 col-form-label">Nik</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nik" value="<?php echo $user['nik'] ?>" class="form-control" id="nik" readonly>
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label for="id_rfid" class="col-sm-2 col-form-label">ID RFID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="id_rfid" value="<?php echo $user['id_rfid'] ?>" class="form-control" id="nama">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" value="<?php echo $user['nama'] ?>" class="form-control" id="nama">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" class="form-control" value="<?php echo $user['alamat'] ?>"><?php echo $user['alamat'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal_lahir" value="<?php echo $user['tanggal_lahir'] ?>" class="form-control" id="tanggal_lahir">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                                    <div class="col-sm-10">
                                        <input type="int" name="no_hp" value="<?php echo $user['no_hp'] ?>" class="form-control" id="no_hp">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="verifikasi" class="col-sm-2 col-form-label">Verifikasi</label>
                                    <div class="col-sm-10">
                                        <select name="verifikasi" id="verifikasi" class="form-control">
                                            <option value="1" <?php if($user['verifikasi'] == 1) { echo "selected"; } ?>>Verifikasi</option>
                                            <option value="0" <?php if($user['verifikasi'] == 0) { echo "selected"; }?>>Belum Verifikasi</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1" <?php if($user['status'] == 1) { echo "selected"; } ?>>Aktif</option>
                                            <option value="0" <?php if($user['status'] == 0) { echo "selected"; }?>>Non Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="simpan" class="btn btn-success form-control">Simpan</button>
                                    </div>
                                </div>
    </section>
    </form>
    <?php
    if (isset($_POST['simpan'])) {
        # code...
        $nik = $_POST['nik'];
        $id_rfid = $_POST['id_rfid'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tanggal_lahir=$_POST['tanggal_lahir'];
        $no_hp = $_POST['no_hp'];
        $verifikasi = $_POST['verifikasi'];
        $status = $_POST['status'];
        // $password= password_hash($_POST['password'], PASSWORD_BCRYPT);

        $simpan = mysqli_query($konek, "UPDATE user SET nik='$nik',id_rfid='$id_rfid', nama='$nama', alamat='$alamat', tanggal_lahir='$tanggal_lahir', no_hp='$no_hp', verifikasi='$verifikasi', status ='$status' WHERE id_user= '$_GET[id_user]'");
        if ($simpan) {
            # code...
            echo "<script>alert('Pendaftaran Telah Divalidasi Admin '); window.location.href='index.php?page=verifikasi'</script>";
        }
    }
    ?>




</div>
</div>
</div>
</section>
</div>
</div>