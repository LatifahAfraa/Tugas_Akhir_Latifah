<?php
require ("koneksi/koneksi.php");

if(isset($_GET['update'])){
    $id_lampu_update = $_GET['update'];
    $waktu_terakhir_scan = date("Y-m-d H:i:s");
    mysqli_query($konek, "UPDATE lampu SET status_lampu='merah', waktu_terakhir_scan='$waktu_terakhir_scan' WHERE id_lampu='$id_lampu_update'");
    mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' WHERE id_lampu <> '$id_lampu_update'");

    
    $hasil = [
        "data_lampu_1" => ($id_lampu_update == 1)? true : false, 
        "data_lampu_2" => ($id_lampu_update == 2)? true : false, 
        "data_lampu_3" => ($id_lampu_update == 3)? true : false,
    ];

    /*
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

if(isset($_GET['lampu']) && isset($_GET['rfid'])) {
    $lampu = $_GET['lampu'];
    $rfid = $_GET['rfid'];

    $table_lampu = mysqli_query($konek, "SELECT * FROM lampu Where id_lampu='$lampu' and status_lampu = 'merah'"); 
    $row_lampu = mysqli_num_rows($table_lampu);
    $data_lampu = mysqli_fetch_assoc($table_lampu);
    if($row_lampu == 0){
        $hasil = [
            "data_lampu_1" => false, 
            "data_lampu_2" => false, 
            "data_lampu_3" => false, 
        ];
    }else{
        $table_user = mysqli_query($konek, "SELECT * FROM user Where id_rfid='$rfid' and verifikasi = 1 and status = 1 ");
        $row_user = mysqli_num_rows($table_user);
        $data_user = mysqli_fetch_assoc($table_user);
        if($row_user == 0){
            $hasil = [
                "data_lampu_1" => false, 
                "data_lampu_2" => false, 
                "data_lampu_3" => false,
            ];
        }else{
            $waktu_scan= date("Y-m-d H:i:s");
            $table_penggunaan = mysqli_query($konek, "INSERT INTO penggunaan (id_lampu, id_user, waktu_scan) VALUES ('$data_lampu[id_lampu]', '$data_user[id_user]', '$waktu_scan')");
            $ubah_table_lampu = mysqli_query($konek, "UPDATE lampu SET waktu_terakhir_scan='$waktu_scan', status_lampu='merah' where id_lampu='$data_lampu[id_lampu]'");
            $ubah_table_lampu = mysqli_query($konek, "UPDATE lampu SET status_lampu='hijau' where id_lampu <> '$data_lampu[id_lampu]'");
            
            $hasil = [
                "data_lampu_1" => ($data_lampu['id_lampu'] == 1)? true : false, 
                "data_lampu_2" => ($data_lampu['id_lampu'] == 2)? true : false, 
                "data_lampu_3" => ($data_lampu['id_lampu'] == 3)? true : false,
            ];
        }
    }

    echo json_encode($hasil);
} else {
    // id_rfid 
    echo json_encode([
        'data_rfid_lampu_1' => true,
        'data_rfid_lampu_2' => false,
        'data_rfid_lampu_3' => false,
    ]);
}
