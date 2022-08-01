<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Riwayat Tap Pada Traffic Light</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Data</a></li>
                        <li class="breadcrumb-item active">Riwayat Tap Pada Traffic Light</li>
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
                            <center><label>List Riwayat Tap Pada Traffic Light</label></center>
                            <!-- <i class="fas fa-plus-circle"><a href="index.php?page=create_lampu">Create Lampu</a></i> -->
                            <table id="admin" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID RFID</th>
                                        <th>Waktu Tap</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    $query = mysqli_query($konek, "SELECT *from log_scan ORDER BY created_at DESC LIMIT 20");
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no = $no + 1; ?></td>
                                            <td><?php echo $row['rfid']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
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