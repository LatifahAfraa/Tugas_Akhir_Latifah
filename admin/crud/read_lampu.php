<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Read Lampu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Data</a></li>
                        <li class="breadcrumb-item active">Read Lampu</li>
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
                            <br>
                            <center><label>List Lampu</label></center>
                            <!-- <i class="fas fa-plus-circle"><a href="index.php?page=create_lampu">Create Lampu</a></i> -->
                            <table id="admin" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lampu</th>
                                        <th>Lokasi Lampu</th>
                                        <th>Waktu Aktif</th>
                                        <th>Tambahan Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    $query = mysqli_query($konek, "SELECT *from lampu ORDER BY id_lampu ASC");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no = $no + 1; ?></td>
                                            <td><?php echo $row['nama_lampu']; ?></td>
                                            <td><?php echo $row['lokasi_lampu']; ?></td>
                                            <td><?php echo $row['waktu_mulai']; ?> - <?php echo $row['waktu_selesai']; ?> WIB</td>
                                            <td><?php echo $row['tambahan_waktu']; ?> <?php if($row['tambahan_waktu'] == 60) {
                                                echo " Detik";
                                                } else {
                                                echo "";
                                                }
                                                ?> </td>
                                                    <td>
                                                        <a href="index.php?page=update_lampu&id_lampu=<?php echo $row['id_lampu'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>

                                                        <!-- <a href="index.php?page=hapus_lampu&id_lampu=<?php echo $row['id_lampu'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a> -->
                                                    </td>
                                        </tr>
                                    <?php } ?>
                                    </tfoot>
                            </table>

                            <a id="cetak" href="" target="_blank" class="btn btn-primary" role="button" title="Cetak Data" style="float: right; margin: 30px 30px 0 0;"><i class="fas fa-print"></i> Cetak</a>
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