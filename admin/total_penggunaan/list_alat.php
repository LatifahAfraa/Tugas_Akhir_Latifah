<?php
$data = mysqli_query($konek, "SELECT * FROM lampu");
$lampu = mysqli_fetch_assoc($data);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Total Penggunaan Setiap Traffic Light</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?page=total_penggunaan_alat">Kelola Data</a></li>
                        <li class="breadcrumb-item active">Total Penggunaan Setiap Traffic Light</li>
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
                            <center><label>Total Penggunaan Pada Setiap Traffic Light</label></center><br><br>
                            <div class="form-group row">
                                <p for="lampu1" class="col-sm-6 col-form-label">Total Penggunaan Lampu Lalu Lintas 1</p>
                                <div class="col-sm-6">
                                    <input type="text" name="lampu1" value="<?php echo $lampu['lampu1'] ?>x" class="form-control" id="waktu_aktif1" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <p for="lampu2" class="col-sm-6 col-form-label">Total PenggunaanLampu Lalu Lintas 2</p>
                                <div class="col-sm-6">
                                    <input type="text" name="lampu2" value="<?php echo $lampu['lampu2'] ?>x" class="form-control" id="waktu_aktif2" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <p for="lampu3" class="col-sm-6 col-form-label">Total Penggunaan Lampu Lalu Lintas 3</p>
                                <div class="col-sm-6">
                                    <input type="text" name="lampu3" value="<?php echo $lampu['lampu3'] ?>x" class="form-control" id="waktu_aktif3" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <p for="lampu4" class="col-sm-6 col-form-label">Total Penggunaan Lampu Lalu Lintas 4</p>
                                <div class="col-sm-6">
                                    <input type="text" name="lampu4" value="<?php echo $lampu['lampu4'] ?>x" class="form-control" id="waktu_aktif4" readonly>
                                </div>
                            </div>


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