<?
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
                --- true: reset durasi lampu pada alat / lcd dan simpan riwayat tap
                --- false: abaikan proses
            -- false:
                -- Ambil data lampu 
                -- Cek parameter sisa waktu (apakah sisa_waktu kecil sama dengan 0)
                    --- true : ubah posisi lampu hijau ke lokasi berikutnya dan reset waktu ke nilai default (DB)
                    --- false : abaikan proses
        
    Output : Tampilakan data_lampu dalam format json
*/

require "koneksi/koneksi.php";

if(isset($_GET['rfid'])){
    $rfid = $_GET['rfid'];
    $lokasi_scan = $_GET['lokasi_scan'];
    $sisa_waktu = $_GET['sisa_waktu'];
    $$now = date('Y-m-d H:i:s');

    if($rfid != "" && $lokasi_scan != 0){

        $user = mysqli_query($konek, "SELECT * FROM user where id_rfid ='$rfid' AND verifikasi = 1 AND status = 1");
        $row_user = mysqli_num_rows($user);

        if($row_user != 0){
            $response['sisa_waktu'] = 60;
            mysqli_query($konek, "INSERT INTO penggunaan (rfid, created_at) VALUES ('$rfid', '$now')");
        }
    }
}


?>