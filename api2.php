<?php 
require "koneksi/koneksi.php";

if(isset($_GET['warna'])){
    $warna= $_GET['warna'];
    $lokasi = $_GET['lokasi'];
    
    $lampu = mysqli_query($konek, "SELECT * FROM lampu WHERE id_lampu='$lokasi' And status_lampu='$warna'");
    $row_lampu = mysqli_fetch_assoc($lampu); // ambil data
    echo "$row lampu";

    //riwayat lampu???????
}
?>


<?php
/*
    - sisa_waktu - wajib
    - rfid - opsional - 123
    - lokasi_scan - opsional, wajib jika rfid terisi
*/

/*
    Input :
        http://localhost/api.php?sisa_waktu=10&rfid=123456&lokasi_scan=2

        http://localhost/index.php?sisa_waktu=10&rfid=123456&lokasi_scan=2
        http://localhost/?sisa_waktu=10&rfid=123456&lokasi_scan=2
    
    Proses :
        - Cek apakah parameter rfid dan lokasi scan tidak kosong
            -- true: Cek RFID di tabel user apakah telah diverifikasi dan aktif
                --- true: tambahkan durasi lampu pada alat / lcd
                --- false: abaikan proses
            -- false: Cek parameter sisa lampu (apakah sisa_lampu kecil sama dengan 0)
                -- true : ubah posisi lampu hijau ke lokasi berikutnya dan reset waktu ke nilai default (DB)
                -- false : abaikan proses
        
    Output : Tampilakan data_lampu dalam format json
*/
require "koneksi/koneksi.php";
if(isset($_GET['sisa_waktu'])){
    $sisa_waktu = $_GET['sisa_waktu'];
    $rfid = $_GET['rfid'] ?? "";
    $lokasi_scan = $_GET['lokasi_scan'] ?? "";

    $lampu = mysqli_query($konek, "SELECT * FROM lampu where status_lampu='hijau'");
    $data_lampu= mysqli_fetch_assoc($lampu);

    if($rfid != "" && $lokasi_scan != "") {
        $user = mysqli_query($konek, "SELECT * FROM user where id_rfid=$rfid");
        $row_user = mysqli_num_rows($user);
        
        if($row_user != 0) {
            $data_user = mysqli_fetch_assoc($user);

            $response['pesan'] = "User telah terdaftar";
        } else {
            $response['pesan'] = "User tidak terdaftar";
        }
    } else {
        $response['pesan'] = "Data tidak lengkap";
    }

    echo json_encode($response);
}

?>