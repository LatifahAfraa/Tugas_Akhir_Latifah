<?php

$tabel_lampu = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu='hijau' ORDER BY id_lampu ASC LIMIT 1");
$data_lampu = mysqli_fetch_assoc($tabel_lampu);

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Monitoring Lampu Hijau Traffic Light</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?page=monitoring">Kelola Data</a></li>
                        <li class="breadcrumb-item active">Monitoring Lampu Hijau Traffic Light</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card bg-danger" id="lampu_3">
                        <div class="card-body text-center">
                            <h4>Lampu 3</h4>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card bg-danger" id="lampu_1">
                        <div class="card-body text-center">
                            <h4>Lampu 1</h4>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="card bg-danger" id="lampu_2">
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <h4>Lampu2</h4>
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
<script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.0/socket.io.min.js"></script>
<script>
    const socket = io("http://localhost:3005");
    socket.on("connect", () => {
        console.log(socket.id); // x8WIv7-mJelg7on_ALbx
        socket.on("ganti-lampu", (datas) => {
            $(".card").removeClass("bg-success").addClass("bg-danger");
            $("#lampu_"+ datas.id_lampu).removeClass("bg-danger").addClass("bg-success");
        });
    });
</script>
<script>
    $(document).ready(() => {
        $("#lampu_<?php echo $data_lampu['id_lampu'] ?>").removeClass("bg-danger").addClass("bg-success");
    });
</script>