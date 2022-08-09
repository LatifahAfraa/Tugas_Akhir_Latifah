<?php  

include "../koneksi/koneksi.php";

$user = mysqli_query($konek, "SELECT * FROM user");
$jumlah_user = mysqli_num_rows($user);

$penggunaan = mysqli_query($konek, "SELECT id_penggunaan FROM penggunaan WHERE waktu_scan LIKE '".date("Y-m-d %")."'");
$jumlah_penggunaan = mysqli_num_rows($penggunaan);


function hariIndo ($hariInggris) {
  switch ($hariInggris) {
    case 'Sunday':
      return 'Minggu';
    case 'Monday':
      return 'Senin';
    case 'Tuesday':
      return 'Selasa';
    case 'Wednesday':
      return 'Rabu';
    case 'Thursday':
      return 'Kamis';
    case 'Friday':
      return 'Jumat';
    case 'Saturday':
      return 'Sabtu';
    default:
      return 'hari tidak valid';
  }
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<!-- Main content -->
	<section class="content">
    <div class="row">
      <div class="col-md-6">
    		<div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $jumlah_user; ?></h3>
            <p>User</p>
          </div>
          <div class="icon">
            <i class="fas fa-users-cog"></i>
          </div>
          <a href="index.php?page=aktif_nonaktif" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <div class="col-md-6">
    		<div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo $jumlah_penggunaan; ?></h3>
            <p>Penggunaan Hari Ini</p>
          </div>
          <div class="icon">
            <i class="fas fa-users-cog"></i>
          </div>
          <a href="#" class="small-box-footer">
            Hari Ini : <?= hariIndo(date('l'))." ".date("d F Y") ?>
          </a>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5>Grafik Penggunaan</h5>
          </div>
          <div class="card-body">
            <canvas id="penggunaan"></canvas>
          </div>
        </div>
      </div>
    </div>
	</section>
	<!-- /.Main content -->

</div>
<!-- /.content-wrapper -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php 

  $labels = [];
  $datas = [];
  for ($i=0; $i < 7; $i++) { 
    $this_date = strtotime("-".$i." days", time());
    $labels[] = hariIndo(date("l", $this_date)).", ".date("d/m", $this_date);
    $query_penggunaan =mysqli_query($konek, "SELECT id_penggunaan FROM penggunaan WHERE waktu_scan LIKE '".date("Y-m-d", $this_date)." %'");
    $datas[] = mysqli_num_rows($query_penggunaan);
  }
  krsort($labels);
  krsort($datas);
  $json_label = json_encode(array_values($labels));
  $json_data = json_encode(array_values($datas));

?>
<script>
  
  const labels = <?= $json_label ?>;

  const data = {
    labels: labels,
    datasets: [{
      label: 'Digunakan',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: <?= $json_data ?>,
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('penggunaan'),
    config
  );
</script>
 