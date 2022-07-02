<?php
$data = mysqli_query($konek, "SELECT * FROM user WHERE id_user ='$_SESSION[id_user]'");
$user = mysqli_fetch_assoc($data);
$query = mysqli_query($konek, "SELECT *, (SELECT COUNT(*) FROM penggunaan WHERE penggunaan.id_user=user.id_user) as total from user WHERE id_user ='$_SESSION[id_user]' ORDER BY id_user ASC");
$q = mysqli_fetch_assoc($query);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Total Penggunaan E-KTP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Total Penggunaan E-KTP</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <center>
                                <h2>Total Penggunaan E-KTP</h2><br>
                            </center>
                            <form action="" method="POST">
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-4 col-form-label">Nik</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nik" value="<?php echo $user['nik'] ?>" class="form-control" id="nik" >
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nama" value="<?php echo $user['nama'] ?>" class="form-control" id="nama">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total" class="col-sm-4 col-form-label">Total Penggunaan E-KTP</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="total" value="<?php echo $q['total'] ?> x"  class="form-control" id="total">
                                    </div>
                                </div>

    </section>
    </form>
    




</div>
</div>
</div>
</section>
</div>
</div>