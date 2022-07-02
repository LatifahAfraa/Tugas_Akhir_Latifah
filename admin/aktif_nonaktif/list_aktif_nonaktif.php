  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Status Aktif RFID Tag</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=aktif_nonaktif">Kelola Data</a></li>
              <li class="breadcrumb-item active">List User</li>
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
                <table id="admin" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Id RFID</th>
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Umur</th>
                    <th>No Hp</th>
                    <th>Verifikasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                $no=0;
                $query=mysqli_query($konek, "SELECT * FROM user WHERE verifikasi=1 ORDER BY id_user ASC");
                while ($row=mysqli_fetch_array($query))
                {
                ?>
                  <tr>
                  <td><?php echo $no=$no+1;?></td>
                  <td><?php echo $row['id_rfid'];?></td>
                  <td><?php echo $row['nik'];?></td>
                  <td><?php echo $row['nama'];?></td>
                  <td><?php echo $row['alamat'];?></td>
                  <td><?php echo $row['tanggal_lahir'];?></td>
                  <td><?= date("Y")-date("Y", strtotime($row['tanggal_lahir'])) ?> Tahun</td>
                  <td><?php echo $row['no_hp'];?></td>
                  <td><?php  if($row['verifikasi'] == 1) {
                                echo "<span class='badge badge-success'>Verifikasi</span>";
                              } else {
                                echo "<span class='badge badge-danger'>Belum Diverifikasi</span>";
                              }
                    ?></td>
                  <td><?php if($row['status'] == 1) {
                    echo "<span class='badge badge-info'>Aktif</span>";
                  } else {
                    echo "<span class='badge badge-secondary'?>Non Aktif</span>";
                  }
                  ?></td>
                  <td>
                    <?php if($row['verifikasi'] == 0){ ?>
                      <a href="index.php?page=proses_aktif_nonaktif&id_user=<?php echo $row['id_user'] ?>" class="btn btn-info"><i class="fa fa-close"></i> Aktifkan</a>
                    <?php } else { ?>
                    <a href="index.php?page=proses_aktif_nonaktif&id_user=<?php echo $row['id_user'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Non Aktifkan</a>
                     <?php } ?>
                    <a href="index.php?page=hapus_user&id_user=<?php echo $row['id_user'] ?>"class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                   </td>
                </tr>
                <?php } ?>
                  </tfoot>
                </table>

                <a id="cetak" href="" target="_blank" class="btn btn-primary" role="button" title="Cetak Data"  style="float: right; margin: 30px 30px 0 0;"><i class="fas fa-print"></i> Cetak</a>
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
  cetak.addEventListener('click', function () {
    window.print();
  })
</script>
</body>
</html>
