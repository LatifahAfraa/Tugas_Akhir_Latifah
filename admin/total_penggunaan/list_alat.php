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
                            <?php
                            $row = mysqli_query($konek, "SELECT * FROM lampu ORDER BY id_lampu");
                            while ($lampu = mysqli_fetch_assoc($row)) {
                                $penggunaan = mysqli_query($konek, "SELECT *FROM penggunaan where id_lampu ='$lampu[id_lampu]'"); //$Lampu 'id_lampu' dari tabel lampu 
                                $total_penggunaan = mysqli_num_rows($penggunaan);
                            ?>
                                <div class="form-group row">
                                    <p for="lampu<?php echo $lampu['id_lampu']?>" class="col-sm-6 col-form-label">Total Penggunaan <?php echo $lampu['nama_lampu']?></p>
                                    <div class="col-sm-6">
                                        <input type="text" name="lampu<?php echo $lampu['id_lampu']?>" value="<?php echo $total_penggunaan; ?>x" class="form-control" id="waktu_aktif1" readonly>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                            <br><center><label>List Penggunaan Setiap Traffic Light</label></center>
                              <table id="admin" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Lampu Lalu Lintas</th>
                                          <th>Lokasi Lampu Lalu Lintas</th>
                                          <th>Nama Pengguna</th>
                                          <th>No Nik</th>
                                          <th>Waktu Penggunaan</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 0; 
                                        $query = mysqli_query($konek, "SELECT penggunaan.*, user.nama, user.nik, lampu.lokasi_lampu  FROM penggunaan LEFT JOIN user ON user.id_user = penggunaan.id_user LEFT JOIN lampu ON lampu.id_lampu =penggunaan.id_lampu ORDER BY waktu_scan DESC
                                        ");
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                          <tr>
                                              <td><?php echo $no = $no + 1; ?></td>
                                              <td>Lampu Lalu Lintas <?php echo $row['id_lampu']; ?></td>
                                              <td><?php echo $row['lokasi_lampu'];?></td>
                                              <td><?php echo $row['nama']; ?> </td>
                                              <td><?php echo $row['nik']; ?> </td>
                                              <td><?php echo $row['waktu_scan']; ?> WIB</td>

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