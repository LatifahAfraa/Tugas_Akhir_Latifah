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
                            <h4>Lampu 2</h4>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(() => {
        // setInterval(, 1);
        setInterval(() => {
            update_lampu()
        }, 1000);
    });

    function update_lampu() {
        $.get("/api.php?baca_lampu=1", (hasil) => {
            let json = JSON.parse(hasil); //pemecahan json ke array
            let keys = Object.keys(json);  //hanya menggambil key dari array berupa waktu, lampu_1, lampu_2, lampu_3 
            keys.forEach((key) => {
                if(key !== "waktu") {
                    if(json[key] == 1) {
                        $('#'+key).removeClass("bg-danger").addClass("bg-success"); //selector berdasarkan atribut id
                    } else {
                        $('#'+key).removeClass("bg-success").addClass("bg-danger");
                    }
                }
            });
        })
    }
</script>