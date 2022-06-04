<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Lampu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kelola Data</a></li>
                        <li class="breadcrumb-item active">Create Lampu</li>
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
                                            <option value="">===Pilih Lampu Lalu Lintas===</option>
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
                                            <option value="">===Pilih Lokasi Lampu Lalu Lintas===</option>
                                            <option value="Jl. S. Parman">Jl. S. Parman</option>
                                            <option value="Jl. Raden Saleh">Jl. Raden Saleh</option>
                                            <option value="Jl. Ir. H. Juanda">Jl. Ir. H. Juanda</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <p for="waktu_aktif" class="col-sm-6 col-form-label">Waktu Aktif</p>
                                    <div class="col-sm-6 row">

                                        <div class="col-sm-6">
                                            <input type="time" name="waktu_mulai" class="form-control" id="waktu_mulai">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="time" name="waktu_selesai" class="form-control" id="waktu_selesai">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <p for="tambahan_waktu" class="col-sm-6 col-form-label">Tambahan Waktu</p>
                                    <div class="col-sm-6">
                                        <select name="tambahan_waktu" class="form-control">
                                        <option value="">Tidak Ada Tambahan Waktu</option>
                                            <option value="60">60 Detik</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="simpan" value="Simpan" class="btn float-right btn btn-primary">
                                </div>

                                <?php
                                if (isset($_POST['simpan'])) {
                                    $nama_lampu = $_POST['nama_lampu'];
                                    $waktu_mulai = $_POST['waktu_mulai'];
                                    $waktu_selesai = $_POST['waktu_selesai'];
                                    $lokasi_lampu = $_POST['lokasi_lampu'];
                                    $tambahan_waktu = $_POST['tambahan_waktu'];

                                    $simpan = mysqli_query($konek, "INSERT INTO lampu (nama_lampu, waktu_mulai, waktu_selesai,lokasi_lampu, tambahan_waktu) VALUES('$nama_lampu', '$waktu_mulai', '$waktu_selesai', '$lokasi_lampu', '$tambahan_waktu')");

                                    if ($simpan) {
                                        echo "<script>alert('Data Berhasil Disimpan');
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