<?php

include "koneksi/koneksi.php";
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <p>
                        <h3>Hello <?php echo $_SESSION['nama']; ?>....
                        <br>Selamat Datang Di Website Lampu Lalu Lintas Ramah Lansia</h3>
                       
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.Main content -->

</div>
<!-- /.content-wrapper -->