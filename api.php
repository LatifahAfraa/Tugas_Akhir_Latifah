<?php
    require "koneksi/koneksi.php";

    function update_lampu($is_scan=false, $lampu_master) {
        global $konek;

        $rfid = $_GET['rfid'];
        $scan = $_GET['scan'];
        $detik = $_GET['detik'];
       
        $lampu_hijau_berikutnya = $lampu_master['lampu_hijau_berikutnya']['value'] ?? 0;
        $lampu_hijau_sebelumnya = $lampu_master['lampu_hijau_sebelumnya']['value'] ?? 0;

        $tambahan_waktu_scan = $lampu_master['tambahan_waktu_scan']['value'];
        $durasi_waktu = $lampu_master['durasi_lampu']['value'];

        $table_lampu_hijau = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu='hijau' LIMIT 1");
        $fetch_lampu_hijau = mysqli_fetch_assoc($table_lampu_hijau);
        // return $is_scan;
        if($is_scan) {
            $lampu_hijau_berikutnya = time()+$tambahan_waktu_scan;
            $lampu_hijau_sebelumnya = time();
            $now= date("Y-m-d H:i:s");

            mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_berikutnya' WHERE name='lampu_hijau_berikutnya'");
            mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_sebelumnya' WHERE name='lampu_hijau_sebelumnya'");
            mysqli_query($konek, "INSERT INTO penggunaan (id_lampu, id_user, waktu_scan) VALUES ('$fetch_lampu_hijau[id_lampu]', '$is_scan', '$now')");

            return $tambahan_waktu_scan;

        } else {

            // if($lampu_hijau_berikutnya == time()) {
            if($detik == 0) {
                $lampu_hijau_berikutnya = time()+$durasi_waktu;  //waktu tunggu
                $lampu_hijau_sebelumnya = time();     //waktu berubah lampu
                
                mysqli_query($konek, "UPDATE lampu SET status_lampu='merah'");
                if($fetch_lampu_hijau['id_lampu'] == 3) {
                    mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='1'");
                } else {
                    $lampu_next_id = $fetch_lampu_hijau['id_lampu'] + 1;
                    mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='$lampu_next_id'");
                }
                
                mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_berikutnya' WHERE name='lampu_hijau_berikutnya'");
                mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_sebelumnya' WHERE name='lampu_hijau_sebelumnya'");
                
                return $durasi_waktu;
                
            // } else if( $lampu_hijau_berikutnya - time() <= -5) {
            //     $lampu_hijau_berikutnya = time()+$durasi_waktu;
            //     $lampu_hijau_sebelumnya = time(); 
                
            //     mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_berikutnya' WHERE name='lampu_hijau_berikutnya'");
            //     mysqli_query($konek, "UPDATE lampu_master SET value='$lampu_hijau_sebelumnya' WHERE name='lampu_hijau_sebelumnya'");
                
            //     return $durasi_waktu;
            } 
            
        }

        return 0;
    }

    if(isset($_GET['rfid'])) {
        

        $rfid = $_GET['rfid'];
        $scan = $_GET['scan'];
        $detik = $_GET['detik'];
        $waktu = 0;

        // Get Lampu Master
        $query_lampu_master = mysqli_query($konek, "SELECT * FROM lampu_master");
        $lampu_master = [];
        while ($fetch_lampu_master = mysqli_fetch_assoc($query_lampu_master)) {
            $lampu_master[$fetch_lampu_master['name']] = $fetch_lampu_master;
        }

        // if($rfid != 0) {
            // SIMPAN LOG SCAN
            $now= date("Y-m-d H:i:s");
            mysqli_query($konek, "INSERT INTO log_scan (rfid, created_at) VALUES ('$rfid', '$now')");
    
            $query_user = mysqli_query($konek, "SELECT * FROM user WHERE id_rfid='$rfid' AND verifikasi='1'");
            $row_user = mysqli_num_rows($query_user);
    
            if($row_user != 0) { // JIKA USER DITEMUKAN => UBAH DATA LAMPU
                // echo json_encode($res);
                $fetch_user = mysqli_fetch_assoc($query_user);
                $waktu = update_lampu($fetch_user['id_user'], $lampu_master);
            } else {
                $waktu = update_lampu(false, $lampu_master);
            }
        // } else {
        //     $waktu = update_lampu(false, $lampu_master);
        // }
        


        $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
        $res = [];
        $res['waktu'] = (int) $waktu;
        // $res['waktu'] = $waktu;
        while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
            $res["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
        }

        //respon yg digunakan untuk alat

        echo json_encode($res);
    }

   