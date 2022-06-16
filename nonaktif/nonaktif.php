<?php
$data = mysqli_query($konek, "SELECT * FROM user WHERE id_user ='$_SESSION[id_user]'");
$user = mysqli_fetch_assoc($data);
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
                                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="total" value="<?php echo $user['alamat'] ?> x"  class="form-control" id="total">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="total" value="<?php echo $user['tanggal_lahir'] ?>"  class="form-control" id="total">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="no_hp" class="col-sm-4 col-form-label">No HP</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="no_hp" value="<?php echo $user['no_hp'] ?>"  class="form-control" id="total">
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