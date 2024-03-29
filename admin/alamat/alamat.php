<?php

if(isset($_GET['page'])){
  $page = $_GET['page'];

  switch ($page) {
    // Verifikasi
    case 'verifikasi';
      include 'verifikasi/List_Verifikasi.php';
    break;
    case 'verifikasi_pendaftaran';
      include 'verifikasi/verifikasi.php';
    break;
    case 'hapus_user';
      include 'verifikasi/hapus_user.php';
    break;

    // =======================================

    // Waktu
    case 'waktu';
      include 'waktu/list_waktu.php';
    break;

    // =======================================
    // monitoring
    case 'monitoring';
      include 'monitoring/monitoring.php';
    break;

    // =======================================
    // riwayat
    case 'riwayat_tap';
      include 'riwayat/riwayat.php';
    break;

    // =======================================



    // alat
    case 'total_penggunaan';
      include 'total_penggunaan/list_alat.php';
    break;

    // =======================================

    // kartu
    case 'kartu';
      include 'kartu/list_kartu.php';
    break;

    case 'setiap_lampu';
      include 'kartu/setiap_lampu.php';
    break;

    // =======================================

    // aktif_nonak
    case 'aktif_nonaktif';
      include 'aktif_nonaktif/list_aktif_nonaktif.php';
    break;

    case 'proses_aktif_nonaktif';
      include 'aktif_nonaktif/aktif_nonaktif.php';
    break;

    case 'hapus_aktif_nonaktif';
      include 'aktif_nonaktif/hapus_aktif_nonaktif.php';
    break;

    // =======================================

    case'create_lampu';
    include 'crud/create_lampu.php';
    break;

    case'read_lampu';
    include 'crud/read_lampu.php';
    break;

    case'update_lampu';
    include 'crud/update_lampu.php';
    break;

    case'hapus_lampu';
    include 'crud/delete_lampu.php';
    break;

    // =======================================

    // user list
    case 'list';
      include 'list/list.php';
    break;

    // =======================================

    // user nonaktif
    case 'nonaktif';
      include 'nonaktif/nonaktif.php';
    break;

    // =======================================

    case 'logout';
      include 'logout.php';
    break;

  }

}else{
  include "dashboard.php";
}
?> 