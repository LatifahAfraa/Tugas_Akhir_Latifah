<?php 
require "koneksi/koneksi.php";

if(isset($_GET['rfid'])) {
    $response['waktu'] = 0;

    $rfid = $_GET['rfid'];
    $scan = (int) $_GET['scan'];
    $sisa_waktu = (int) $_GET['detik'];

    $now = date("Y-m-d H:i:s"); //inisialisasikan waktu saat ini
    
    $query_lampu_master = mysqli_query($konek, "SELECT * FROM lampu_master");
    $lampu_master = []; //menyimpan data dari tabel lampu master ke variabel lampu_master
    while ($fetch_lampu_master = mysqli_fetch_assoc($query_lampu_master)) {
        $lampu_master[$fetch_lampu_master['name']] = $fetch_lampu_master;
    }

    $tambahan_waktu_scan = $lampu_master['tambahan_waktu_scan']['value'];
    $durasi_waktu = $lampu_master['durasi_lampu']['value'];

    $table_lampu_hijau = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu='hijau' LIMIT 1");
    $fetch_lampu_hijau = mysqli_fetch_assoc($table_lampu_hijau);
    
    if($scan AND !empty($rfid)) {
        $now = date("Y-m-d H:i:s");
        mysqli_query($konek, "INSERT INTO log_scan (rfid, created_at) VALUES ('$rfid', '$now')");
    
        $query_user = mysqli_query($konek, "SELECT * FROM user WHERE id_rfid='$rfid' AND verifikasi='1'");
        $row_user = mysqli_num_rows($query_user);
    
        if($row_user != 0) {
            $fetch_user = mysqli_fetch_assoc($query_user);
            $response['waktu'] = scan_proses($tambahan_waktu_scan, $scan, $fetch_user['id_user']);
        }
    } else {
        $response['sisa_waktu'] = $sisa_waktu;
        if($sisa_waktu <= 0) {
            $response['waktu'] = timeout_proses($durasi_waktu, $fetch_lampu_hijau['id_lampu']);
        }
    }

    $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
    while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
        $response["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
    }

    echo json_encode($response);
}

function scan_proses($tambahan_waktu_scan, $id_lampu_scan, $id_user) {
    global $konek;
    
    $now= date("Y-m-d H:i:s");
    mysqli_query($konek, "INSERT INTO penggunaan (id_lampu, id_user, waktu_scan) VALUES ('$id_lampu_scan', '$id_user', '$now')");
    
    return (int) $tambahan_waktu_scan;
}

function timeout_proses($durasi_waktu, $id_lampu_hijau)
{
    global $konek;
    
    mysqli_query($konek, "UPDATE lampu SET status_lampu='merah'");
    if($id_lampu_hijau == 3) { //pengecekan id lampu hijau saat ini, jika id 3 di ubah ke lampu 1
        mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='1'");
    } else {
        $lampu_next_id = $id_lampu_hijau + 1;
        mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='$lampu_next_id'");
    }
    
    return (int) $durasi_waktu; //mengembalikan waktu dari db
}

if(isset($_GET['baca_lampu'])) { //membaca data lampu
    $response['waktu'] = 0;
    $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
    while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
        $response["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
    }
    
    echo json_encode($response);
}