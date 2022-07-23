<?php
$data = mysqli_query($konek, "SELECT * FROM lampu WHERE id_lampu ='$_GET[id_lampu]'");
$lampu = mysqli_fetch_assoc($data);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Lampu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Data</a></li>
                        <li class="breadcrumb-item active">Update Lampu</li>
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

                        <div class="card-body">
                            <form action="" method="post">
                            <div class="form-group row">
                                <p for="nama_lampu" class="col-sm-6 col-form-label">Nama Lampu</p>
                                <div class="col-sm-6">
                                    <select name="nama_lampu" class="form-control">
                                            <option value="<?php echo $lampu['nama_lampu']?>"><?php echo $lampu['nama_lampu']?></option>
                                            <option value="Lampu Lalu Lintas 1">Lampu Lalu Lintas 1</option>
                                            <option value="Lampu Lalu Lintas 2">Lampu Lalu Lintas 2</option>
                                            <option value="Lampu Lalu Lintas 3">Lampu Lalu Lintas 3</option>
                                        </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <p for="lokasi_lampu" class="col-sm-6 col-form-label">Lokasi Lampu</p>
                                <div class="col-sm-6">
                                    <select name="lokasi_lampu" class="form-control">
                                            <option value="<?php echo $lampu['lokasi_lampu']?>"><?php echo $lampu['lokasi_lampu']?></option>
                                            <option value="Jl. S. Parman">Jl. S. Parman</option>
                                            <option value="Jl. Raden Saleh">Jl. Raden Saleh</option>
                                            <option value="Jl. Ir. H. Juanda">Jl. Ir. H. Juanda</option>
                                        </select>
                                </div>
                            </div>

                            

                           <div class="form-group">
                                <input type="submit" name="simpan" value="Simpan" class="btn float-right btn btn-primary">
                            </div>

                            <?php
                            if (isset($_POST['simpan'])) {
                                $nama_lampu = $_POST['nama_lampu'];
                                $lokasi_lampu = $_POST['lokasi_lampu'];
                                

                                $simpan = mysqli_query($konek, "UPDATE lampu SET nama_lampu='$nama_lampu', lokasi_lampu='$lokasi_lampu' WHERE id_lampu ='$_GET[id_lampu]'");

                                if ($simpan) {
                                    echo "<script>alert('Data Berhasil Diperbaharui');
                            window.location.href='index.php?page=read_lampu'</script>";
                                }
                            }
                            ?>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>