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
                --- true: reset durasi lampu pada alat / lcd
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
    $sisa_waktu = $_GET['sisa_waktu'];
    $lokasi_scan = $_GET['lokasi_scan'];

    $response = [
        'rfid' => $rfid,
        'lokasi_scan' => $lokasi_scan,
        'sisa_waktu' => $sisa_waktu,
    ];
    if($rfid != "" AND $lokasi_scan != "" ){
        
        $user = mysqli_query($konek, "SELECT * FROM user where id_rfid = '$rfid' AND verifikasi = 1 AND status = 1");
        $row_user = mysqli_num_rows($user);

        if($row_user != 0){
            $response['sisa_waktu'] = 60;
        }
    }
    else{
        $lampu = mysqli_query($konek, "SELECT * FROM lampu where status_lampu='hijau'");
        $data_lampu = mysqli_fetch_assoc($lampu);
        // (condition)? true: false
        // (1 == 1)? "benar" : "salah" == benar
        // (1 == 2)? "benar" : "salah" == salah
    
        if($sisa_waktu <= 0){
            $id_selanjutnya = ($data_lampu['id_lampu']==3) ? 1 : ($data_lampu['id_lampu']+1); 
            mysqli_query($konek, "UPDATE lampu SET status_lampu = 'merah' where  id_lampu='$data_lampu[id_lampu]'");
            mysqli_query($konek, "UPDATE lampu SET status_lampu = 'hijau' where  id_lampu='$id_selanjutnya'");
            $response['sisa_waktu'] = 30;
        }
        

    }

    echo json_encode($response);

}
