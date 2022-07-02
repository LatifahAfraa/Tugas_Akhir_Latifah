<?php
require ("koneksi/koneksi.php");

if(isset($_GET['update'])){  //pergantian lampu lalu lintas, api sesuai alat
    $id_lampu_update = $_GET['update'];
    $waktu_terakhir_scan = date("Y-m-d H:i:s");
    $jam_sekarang = date("H:i").":00";

    // echo "SELECT * FROM lampu WHERE '$jam_sekarang' NOT BETWEEN  TIME_FORMAT(waktu_mulai, '%T') AND TIME_FORMAT(waktu_selesai, '%T')";

    $query_lampu = mysqli_query($konek, "SELECT * FROM lampu WHERE '$jam_sekarang' NOT BETWEEN  TIME_FORMAT(waktu_mulai, '%T') AND TIME_FORMAT(waktu_selesai, '%T') AND  id_lampu='$id_lampu_update'");
    $row_lampu = mysqli_num_rows($query_lampu);

    $fetch_lampu = mysqli_fetch_assoc($query_lampu);

    if($row_lampu > 0) {
        mysqli_query($konek, "UPDATE lampu SET status_lampu='kuning', waktu_terakhir_scan='$waktu_terakhir_scan' WHERE id_lampu='$id_lampu_update'");

        /*
            Jika nilai warna = true maka data lampu yang bernilai true berwarna hijau
            Jika nilai warna = false maka data lampu yang bernilai true berwarna kuning
        */
        $hasil = [ //kuning
            'warna' => false, // kuning 
            "data_lampu_1" => true, 
            "data_lampu_2" => true, 
            "data_lampu_3" => true,
        ];
    } else {
        // $query_lampu = mysqli_query($konek, "SELECT * FROM lampu WHERE id_lampu='$id_lampu_update'");
        // $fetch_lampu = mysqli_fetch_assoc($query_lampu);

        mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau', waktu_terakhir_scan='$waktu_terakhir_scan' WHERE id_lampu='$id_lampu_update'");
        mysqli_query($konek, "UPDATE lampu SET status_lampu='merah' WHERE id_lampu <> '$id_lampu_update'");
        $waktu_selesai = date("Y-m-d H:i:s", time()+ 30);
        $table_riwayat_lampu = mysqli_query($konek, "INSERT INTO riwayat_lampu (event, lampu_id, waktu_mulai, waktu_selesai, id_lampu_hijau) VALUES ('timer', '$id_lampu_update', '$waktu_terakhir_scan', '$waktu_selesai', '$id_lampu_update')");
    
        
        $hasil = [
            'warna' => true, // hijau
            "data_lampu_1" => ($id_lampu_update == 1)? true : false, 
            "data_lampu_2" => ($id_lampu_update == 2)? true : false, 
            "data_lampu_3" => ($id_lampu_update == 3)? true : false,
        ];
    }

    /* alat sesuai api
    $table_lampu= mysqli_query($konek, "SELECT * FROM  lampu where status_lampu = 'merah' ORDER BY id_lampu ASC LIMIT 1");
    $data_lampu = mysqli_fetch_assoc($table_lampu);

    $time_terakhir_scan = strtotime($data_lampu['waktu_terakhir_scan']);

    if(($time_terakhir_scan + $data_lampu['tambahan_waktu']) <= time()) {
        $lampu_merah_berikutnya = ($data_lampu['id_lampu'] == 3) ? 1 : $data_lampu['id_lampu']+1;
        $waktu_terakhir_scan = date("Y-m-d H:i:s");
        mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_terakhir_scan' WHERE id_lampu='$lampu_merah_berikutnya'");
        mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu <> '$lampu_merah_berikutnya'");

        
        $hasil = [
            "data_lampu_1" => ($lampu_merah_berikutnya == 1)? true : false, 
            "data_lampu_2" => ($lampu_merah_berikutnya == 2)? true : false, 
            "data_lampu_3" => ($lampu_merah_berikutnya == 3)? true : false,
        ];
    } else {
        
        $hasil = [
            "data_lampu_1" => ($data_lampu['id_lampu'] == 1)? true : false, 
            "data_lampu_2" => ($data_lampu['id_lampu'] == 2)? true : false, 
            "data_lampu_3" => ($data_lampu['id_lampu'] == 3)? true : false,
        ];
    }
    */

    echo json_encode($hasil);
    die();
}

if(isset($_GET['lampu']) && isset($_GET['rfid'])) { // untuk scan
    $lampu = $_GET['lampu'];
    $rfid = $_GET['rfid'];

    $query_riwayat_lampu = mysqli_query($konek, "SELECT * FROM riwayat_lampu ORDER BY id DESC LIMIT 1");
    $row_riwayat_lampu = mysqli_num_rows($query_riwayat_lampu);
    $fetch_riwayat_lampu = mysqli_fetch_assoc($query_riwayat_lampu);


    
    function update_lampu($lampu, $rfid) {
        global $konek;
        $table_lampu = mysqli_query($konek, "SELECT * FROM lampu Where id_lampu='$lampu' and status_lampu = 'merah'"); 
        $row_lampu = mysqli_num_rows($table_lampu);
        $data_lampu = mysqli_fetch_assoc($table_lampu);
    
        $query_lampu_hijau = mysqli_query($konek, "SELECT * FROM lampu WHERE status_lampu = 'hijau' ORDER BY id_lampu DESC LIMIT 1");
        $fetch_lampu_hijau = mysqli_fetch_assoc($query_lampu_hijau);
    
        if($row_lampu == 0){ // lampu tidak berwarna merah sehingga tidak dapat di intrupsi
    
            $hasil = [
                "warna" => true,
                "data_lampu_1" => ($fetch_lampu_hijau['id_lampu'] == 1)? true : false, 
                "data_lampu_2" => ($fetch_lampu_hijau['id_lampu'] == 2)? true : false, 
                "data_lampu_3" => ($fetch_lampu_hijau['id_lampu'] == 3)? true : false,
            ];
        }else{ // lampu berwarna merah
            $table_user = mysqli_query($konek, "SELECT * FROM user Where id_rfid='$rfid' and verifikasi = 1 and status = 1 ");
            $row_user = mysqli_num_rows($table_user);
            // echo $row_user;
            $data_user = mysqli_fetch_assoc($table_user);
            if($row_user == 0){ // User yang melakukan scan tidak terdaftar atau belum di berifikasai atau telah dinon aktifkan
        
                $hasil = [
                    "warna" => true,
                    "data_lampu_1" => ($fetch_lampu_hijau['id_lampu'] == 1)? true : false, 
                    "data_lampu_2" => ($fetch_lampu_hijau['id_lampu'] == 2)? true : false, 
                    "data_lampu_3" => ($fetch_lampu_hijau['id_lampu'] == 3)? true : false,
                ];
    
            }else{ // User ditemukan dan telah diverifikasi silahkan diteruskan
                $waktu_scan= date("Y-m-d H:i:s");
                $table_penggunaan = mysqli_query($konek, "INSERT INTO penggunaan (id_lampu, id_user, waktu_scan) VALUES ('$data_lampu[id_lampu]', '$data_user[id_user]', '$waktu_scan')");
                $ubah_table_lampu = mysqli_query($konek, "UPDATE lampu SET waktu_terakhir_scan='$waktu_scan', status_lampu='merah' where id_lampu='$data_lampu[id_lampu]'");
                // $ubah_table_lampu = mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' where id_lampu <> '$data_lampu[id_lampu]'");
                $waktu_selesai = date("Y-m-d H:i:s", time()+60);
                $table_riwayat_lampu = mysqli_query($konek, "INSERT INTO riwayat_lampu (event, lampu_id, waktu_mulai, waktu_selesai, id_lampu_hijau) VALUES ('scan', '$data_lampu[id_lampu]', '$waktu_scan', '$waktu_selesai', '$fetch_lampu_hijau[id_lampu]')");
                
                $hasil = [
                    "warna" => true,
                    "data_lampu_1" => ($fetch_lampu_hijau['id_lampu'] == 1)? true : false, 
                    "data_lampu_2" => ($fetch_lampu_hijau['id_lampu'] == 2)? true : false, 
                    "data_lampu_3" => ($fetch_lampu_hijau['id_lampu'] == 3)? true : false,
                ];
            }
        }

        return $hasil;
    }

    if($row_riwayat_lampu == 0) {
        $hasil = update_lampu($lampu, $rfid);

    } else {

        if($fetch_riwayat_lampu['id_lampu_hijau'] != $lampu) {
            $hasil = update_lampu($lampu, $rfid);
        } else {
            $hasil = [
                "warna" => true,
                "data_lampu_1" => ($fetch_riwayat_lampu['id_lampu_hijau'] == 1)? true : false, 
                "data_lampu_2" => ($fetch_riwayat_lampu['id_lampu_hijau'] == 2)? true : false, 
                "data_lampu_3" => ($fetch_riwayat_lampu['id_lampu_hijau'] == 3)? true : false,
            ];
        }

    }


    

    echo json_encode($hasil);
} else {
    // id_rfid 
    echo json_encode([
        "warna" => true,
        'data_rfid_lampu_1' => true,
        'data_rfid_lampu_2' => false,
        'data_rfid_lampu_3' => false,
    ]);
}
