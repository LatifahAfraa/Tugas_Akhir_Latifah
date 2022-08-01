<?php
                            if (isset($_POST['simpan'])) {
                                $tambahan_waktu_scan = $_POST['tambahan_waktu_scan'];
                                $durasi_lampu = $_POST['durasi_lampu'];
                                $simpan = mysqli_query($konek, "UPDATE lampu_master SET value='$tambahan_waktu_scan' WHERE name='tambahan_waktu_scan'");
                                $simpan = mysqli_query($konek, "UPDATE lampu_master SET value='$durasi_lampu' WHERE name='durasi_lampu'");

                                if ($simpan) {
                                    echo "<script>alert('Data Berhasil Diperbaharui');
                            window.location.href='index.php?page=waktu'</script>";
                                }
                            }
                             //proses update data terlebih dahulu, baru ditampilkan data yg ada pada db

                            ?>
                            
<?php
$data = mysqli_query($konek, "SELECT * FROM lampu_master WHERE id IN ('3','4')");
while ($master = mysqli_fetch_assoc($data)) {
    $data_master[$master['name']] = $master['value']; //pengambilan nilai dari field name db sesuai value yg dilooping
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaturan Waktu Traffic Light</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?page=waktu">Kelola Data</a></li>
                        <li class="breadcrumb-item active">Pengaturan Waktu Traffic Light</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group row">
                                    <p for="tambahan_waktu_scan" class="col-sm-6 col-form-label">Tambahan Waktu Scan</p>
                                    <div class="col-sm-6">
                                        <input type="text" name="tambahan_waktu_scan" value="<?php echo $data_master['tambahan_waktu_scan'] ?>" class="form-control" id="tambahan_waktu_scan">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <p for="durasi_lampu" class="col-sm-6 col-form-label">Durasi Lampu</p>
                                    <div class="col-sm-6">
                                        <input type="text" name="durasi_lampu" value="<?php echo $data_master['durasi_lampu'] ?>" class="form-control" id="durasi_lampu">
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <input type="submit" name="simpan" value="simpan" class="btn float-right btn btn-primary">
                                </div>


                            </form>
                           
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->


<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    cetak.addEventListener('click', function() {
        window.print();
    })
</script>
</body>

</html>