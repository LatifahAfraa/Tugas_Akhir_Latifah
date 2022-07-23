<?php
    require "koneksi/koneksi.php";

    function update_lampu($is_scan=false, $lampu_master) {
        global $konek;
        $waktu_sekarang = date('Y-m-d H:i:s');

        $next_change_at = $lampu_master['next_change_at']['value'] ?? 0;
        $latest_change_at = $lampu_master['latest_change_at']['value'] ?? 0;

        $tambahan_waktu_scan = $lampu_master['tambahan_waktu_scan']['value'];
        $durasi_waktu = $lampu_master['durasi_lampu']['value'];

        if($is_scan) {
            // $table_lampu_hijau = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu='hijau' LIMIT 1");
            // $fetch_lampu_hijau = mysqli_fetch_assoc($table_lampu_hijau);
            $next_change_at = time()+$tambahan_waktu_scan;
            $latest_change_at = time();
            mysqli_query($konek, "UPDATE lampu_master SET value='$next_change_at' WHERE name='next_change_at'");
            mysqli_query($konek, "UPDATE lampu_master SET value='$latest_change_at' WHERE name='latest_change_at'");

            return $tambahan_waktu_scan;

            // mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='$fetch_lampu_hijau[id_lampu]'");
            
            // if(time() > (strtotime($fetch_lampu_hijau['waktu_terakhir_scan'])+$tambahan_waktu_scan)) {
            //     mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='$fetch_lampu_hijau[id_lampu]'");
            //     if($fetch_lampu_hijau['id_lampu'] == 3) {
            //         mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='1'");
            //     } else {
            //         mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='".($fetch_lampu_hijau['id_lampu']+1)."'");
            //     }
            // }

        } else {

            if($next_change_at == time()) {
                $next_change_at = time()+$durasi_waktu;  //waktu tunggu
                $latest_change_at = time();     //waktu berubah lampu

                $table_lampu_hijau = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu='hijau' LIMIT 1");
                $fetch_lampu_hijau = mysqli_fetch_assoc($table_lampu_hijau);
                
                mysqli_query($konek, "UPDATE lampu SET status_lampu='merah'");
                if($fetch_lampu_hijau['id_lampu'] == 3) {
                    mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='1'");
                } else {
                    $lampu_next_id = $fetch_lampu_hijau['id_lampu'] + 1;
                    mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu='$lampu_next_id'");
                }
                
                mysqli_query($konek, "UPDATE lampu_master SET value='$next_change_at' WHERE name='next_change_at'");
                mysqli_query($konek, "UPDATE lampu_master SET value='$latest_change_at' WHERE name='latest_change_at'");
                
                return $durasi_waktu;
                
            } else if( $next_change_at - time() <= -5) {
                $next_change_at = time()+$durasi_waktu;
                $latest_change_at = time(); 
                
                mysqli_query($konek, "UPDATE lampu_master SET value='$next_change_at' WHERE name='next_change_at'");
                mysqli_query($konek, "UPDATE lampu_master SET value='$latest_change_at' WHERE name='latest_change_at'");
                
                return $durasi_waktu;
            } 
            /*
            $table_lampu = mysqli_query($konek, "SELECT * FROM lampu ORDER BY id_lampu ASC"); 
            // $current_lampu = 
            $i = 1;
            while($fetch_lampu = mysqli_fetch_assoc($table_lampu)) {
                
                // if($fetch_lampu['status_lampu'] == "hijau") {
                    if(time() >  strtotime($fetch_lampu['waktu_terakhir_scan'])+$durasi_waktu) {
                        if($fetch_lampu['id_lampu'] == 3) {
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu=3");
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu=1");
                        } else {
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='".$fetch_lampu['id_lampu']."'");
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='".($fetch_lampu['id_lampu']+1)."'");
                        }
                    }
                // }
                $i++;
            }
            */
        }

        return 0;
    }

    if(isset($_GET['rfid'])) {
        // $lampu_1 = $_GET['device1'] ?? 0; api mengikuti
        // $lampu_2 = $_GET['device2'] ?? 0;
        // $lampu_3 = $_GET['device3'] ?? 0;

        $rfid = $_GET['rfid'];
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
                $waktu = update_lampu(true, $lampu_master);
            } else {
                $waktu = update_lampu(false, $lampu_master);
            }
        // } else {
        //     $waktu = update_lampu(false, $lampu_master);
        // }
        


        $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
        $res = [];
        $res['waktu'] = (int) $waktu;
        while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
            $res["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
        }

        //respon yg digunakan untuk alat

        echo json_encode($res);
    }

    /*
    if(isset($_GET['devices'])) {

        $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
        $res = [];
        
        while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
            $res["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
        }

        echo json_encode($res);
    }
    */