<?php
require "koneksi/koneksi.php";

if(isset($_GET['rfid'])) {
    $response['waktu'] = 0;

    $rfid = $_GET['rfid'];
    $scan = $_GET['scan'];
    $sisa_waktu = $_GET['detik'];

    $now = date("Y-m-d H:i:s");
    
    $query_lampu_master = mysqli_query($konek, "SELECT * FROM lampu_master");
    $lampu_master = [];
    while ($fetch_lampu_master = mysqli_fetch_assoc($query_lampu_master)) {
        $lampu_master[$fetch_lampu_master['name']] = $fetch_lampu_master;
    }
    
    $lampu_hijau_berikutnya = $lampu_master['lampu_hijau_berikutnya']['value'] ?? 0;
    $lampu_hijau_sebelumnya = $lampu_master['lampu_hijau_sebelumnya']['value'] ?? 0;

    $tambahan_waktu_scan = $lampu_master['tambahan_waktu_scan']['value'];
    $durasi_waktu = $lampu_master['durasi_lampu']['value'];

    $table_lampu_hijau = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu='hijau' LIMIT 1");
    $fetch_lampu_hijau = mysqli_fetch_assoc($table_lampu_hijau);
    
    if($scan) {
        $now = date("Y-m-d H:i:s");
        mysqli_query($konek, "INSERT INTO log_scan (rfid, created_at) VALUES ('$rfid', '$now')");
    
        $query_user = mysqli_query($konek, "SELECT * FROM user WHERE id_rfid='$rfid' AND verifikasi='1'");
        $row_user = mysqli_num_rows($query_user);
    
        if($row_user != 0) {
            $fetch_user = mysqli_fetch_assoc($query_user);
            $response['waktu'] = scan_proses($tambahan_waktu_scan, $fetch_lampu_hijau['id_lampu'], $fetch_user['id_user']);
        }
    } else {
        if($sisa_waktu <= 0) {
            $response['sisa_waktu'] = $sisa_waktu;
            $response['waktu'] = timeout_proses($durasi_waktu, $fetch_lampu_hijau['id_lampu']);
        }
    }

    $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
    while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
        $response["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
    }

    echo json_encode($response);
}

function scan_proses($tambahan_waktu_scan, $id_lampu_hijau, $id_user) {
    global $konek;
    
    $lampu_hijau_berikutnya = time()+$tambahan_waktu_scan;
    $lampu_hijau_sebelumnya = time();
    $now= date("Y-m-d H:i:s");

    mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_berikutnya' WHERE name='lampu_hijau_berikutnya'");
    mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_sebelumnya' WHERE name='lampu_hijau_sebelumnya'");
    mysqli_query($konek, "INSERT INTO penggunaan (id_lampu, id_user, waktu_scan) VALUES ('$id_lampu_hijau', '$id_user', '$now')");

    return (int) $tambahan_waktu_scan;
}

function timeout_proses($durasi_waktu, $id_lampu_hijau)
{
    global $konek;

    $lampu_hijau_berikutnya = time()+$durasi_waktu;
    $lampu_hijau_sebelumnya = time();
    
    mysqli_query($konek, "UPDATE lampu SET status_lampu='merah'");
    if($id_lampu_hijau == 3) {
        mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='1'");
    } else {
        $lampu_next_id = $id_lampu_hijau + 1;
        mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='$lampu_next_id'");
    }
    
    mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_berikutnya' WHERE name='lampu_hijau_berikutnya'");
    mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_sebelumnya' WHERE name='lampu_hijau_sebelumnya'");
    
    return (int) $durasi_waktu;
}