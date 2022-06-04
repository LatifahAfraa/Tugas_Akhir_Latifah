<?php
$data = mysqli_query($konek, "SELECT * FROM waktu");
$waktu = mysqli_fetch_assoc($data);
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Waktu Aktif Traffic Light</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="index.php?page=waktu">Kelola Data</a></li>
                          <li class="breadcrumb-item active">Waktu Aktif Traffic Light</li>
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
                              <div class="form-group row">
                                  <p for="waktu_aktif1" class="col-sm-6 col-form-label">Waktu Aktif Lampu Lalu Lintas 1</p>
                                  <div class="col-sm-6">
                                      <input type="text" name="waktu_aktif1" value="<?php echo $waktu['waktu_aktif1'] ?> WIB" class="form-control" id="waktu_aktif1" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <p for="waktu_aktif2" class="col-sm-6 col-form-label">Waktu Aktif Lampu Lalu Lintas 2</p>
                                  <div class="col-sm-6">
                                      <input type="text" name="waktu_aktif2" value="<?php echo $waktu['waktu_aktif2'] ?> WIB" class="form-control" id="waktu_aktif2" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <p for="waktu_aktif3" class="col-sm-6 col-form-label">Waktu Aktif Lampu Lalu Lintas 3</p>
                                  <div class="col-sm-6">
                                      <input type="text" name="waktu_aktif3" value="<?php echo $waktu['waktu_aktif3'] ?> WIB" class="form-control" id="waktu_aktif3" readonly>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <p for="waktu_aktif4" class="col-sm-6 col-form-label">Waktu Aktif Lampu Lalu Lintas 4</p>
                                  <div class="col-sm-6">
                                      <input type="text" name="waktu_aktif4" value="<?php echo $waktu['waktu_aktif4'] ?> WIB" class="form-control" id="waktu_aktif4" readonly>
                                  </div>
                              </div>

                              <br><center><label>List Penambahan Waktu Pada Setiap Traffic Light</label></center>
                              <table id="admin" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Lampu Lalu Lintas 1</th>
                                          <th>Lampu Lalu Lintas 2</th>
                                          <th>Lampu Lalu Lintas 3</th>
                                          <th>Lampu Lalu Lintas 4</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 0;
                                        $query = mysqli_query($konek, "SELECT * FROM waktu ORDER BY id_waktu ASC");
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                          <tr>
                                              <td><?php echo $no = $no + 1; ?></td>
                                              <td><?php echo $row['tambah_waktu1']; ?> Menit</td>
                                              <td><?php echo $row['tambah_waktu2']; ?> Menit</td>
                                              <td><?php echo $row['tambah_waktu3']; ?> Menit</td>
                                              <td><?php echo $row['tambah_waktu4']; ?> Menit</td>

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