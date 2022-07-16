<?php
    require "koneksi/koneksi.php";

    function update_lampu($is_scan=false) {
        global $konek;
        $waktu_sekarang = date('Y-m-d H:i:s');
        $tambahan_waktu = 60;
        $durasi_waktu = 30;

        if($is_scan) {
            $table_lampu_hijau = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu='hijau' LIMIT 1");
            $fetch_lampu_hijau = mysqli_fetch_assoc($table_lampu_hijau);

            if(date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($fetch_lampu_hijau['waktu_terakhir_scan'])+$tambahan_waktu)) {
                mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' ' WHERE id_lampu='$fetch_lampu_hijau[id_lampu]'");
                if($fetch_lampu_hijau['id_lampu'] == 3) {
                    mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau', waktu_terakhir_scan='$waktu_sekarang' ' WHERE id_lampu='1'");
                } else {
                    mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' ' WHERE id_lampu='".($fetch_lampu_hijau['id_lampu']+1)."'");
                }
            }

        } else {
            $table_lampu = mysqli_query($konek, "SELECT * FROM lampu ORDER BY id_lampu ASC"); 
            // $current_lampu = 
            $i = 1;
            while($fetch_lampu = mysqli_fetch_assoc($table_lampu)) {
                
                if($fetch_lampu['status_lampu'] == "hijau") {
                    if(time() >  strtotime($fetch_lampu['waktu_terakhir_scan'])+$durasi_waktu) {
                        if($fetch_lampu['id_lampu'] == 3) {
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu=3");
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu=1");
                        } else {
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='".$fetch_lampu['id_lampu']."'");
                            mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau', waktu_terakhir_scan='$waktu_sekarang' WHERE id_lampu='".($fetch_lampu['id_lampu']+1)."'");
                        }
                    }
                }
                $i++;
            }
        }

        return true;
    }

    if(isset($_GET['rfid'])) {
        $lampu_1 = $_GET['device1'] ?? 0;
        $lampu_2 = $_GET['device2'] ?? 0;
        $lampu_3 = $_GET['device3'] ?? 0;

        $rfid = $_GET['rfid'];

        if($rfid != 0) {
            // SIMPAN LOG SCAN
            $now= date("Y-m-d H:i:s");
            mysqli_query($konek, "INSERT INTO log_scan (rfid, created_at) VALUES ('$rfid', '$now')");
    
            $query_user = mysqli_query($konek, "SELECT * FROM user WHERE id_rfid='$rfid'");
            $row_user = mysqli_num_rows($query_user);
    
            if($row_user != 0) { // JIKA USER DITEMUKAN => UBAH DATA LAMPU
                // echo json_encode($res);
                update_lampu(true);
            } else {
                update_lampu();
            }
        } else {
            update_lampu();
        }
        


        $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
        $res = [];
        
        while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
            $res["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
        }

        echo json_encode($res);
    }

    if(isset($_GET['devices'])) {

        $query_lampu = mysqli_query($konek, "SELECT * FROM lampu");
        $res = [];
        
        while ($fetch_lampu = mysqli_fetch_assoc($query_lampu)) {
            $res["lampu_".$fetch_lampu['id_lampu']] = ($fetch_lampu['status_lampu'] == "hijau")? 1 : 3;
        }

        echo json_encode($res);
    }