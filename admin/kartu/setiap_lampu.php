
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Total Penggunaan Kartu RFID Di Setiap Traffic Light</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="index.php?page=kartu">Kelola Data</a></li>
                          <li class="breadcrumb-item active">Total Penggunaan Kartu RFID Di Setiap Traffic Light</li>
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
                              <br><center><label>List Total Penggunaan Kartu RFID Oleh Setiap Lansia Di Setiap Traffic Light</label></center>
                              <table id="admin" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>NIK</th>
                                          <th>Nama</th>
                                          <th>Total Penggunaan Kartu RFID</th>
                                          <th>Traffic Light 1</th>
                                          <th>Traffic Light 2</th>
                                          <th>Traffic Light 3</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 0;
                                        // SELECT *from LEFT JOIN FROM user ON kartu.user=id_kartu.id_kartu
                                        $query = mysqli_query($konek, "SELECT user.*, (SELECT count(*) FROM penggunaan WHERE id_user=user.id_user) as total_lampu, (SELECT count(*) FROM penggunaan WHERE id_user=user.id_user AND id_lampu='1') as total_lampu_1, (SELECT count(*) FROM penggunaan WHERE id_user=user.id_user AND id_lampu='2') as total_lampu_2, (SELECT count(*) FROM penggunaan WHERE id_user=user.id_user AND id_lampu='3') as total_lampu_3  FROM user");

                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                          <tr>
                                              <td><?php echo $no = $no + 1; ?></td>
                                              <td><?php echo $row['nik']; ?></td>
                                              <td><?php echo $row['nama']; ?></td>
                                              <td><?php echo $row['total_lampu_1'];?> x</td>
                                              <td><?php echo $row['total_lampu_2'];?> x</td>
                                              <td><?php echo $row['total_lampu_3'];?> x</td>
                                              <td><?php echo $row['total_lampu']; ?> x</td>
                                              

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