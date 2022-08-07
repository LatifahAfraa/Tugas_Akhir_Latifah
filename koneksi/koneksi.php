<?php
date_default_timezone_set("Asia/Jakarta");

// $konek = mysqli_connect('db-ta.cs50f4xozssp.us-east-1.rds.amazonaws.com', 'admin', 'admin12345') or die ('connect failed!!');
$konek = mysqli_connect('localhost', 'root', '') or die ('connect failed!!');
/*echo "berhasil terkoneksi.....";
*/
mysqli_select_db($konek, 'ta_latifah') or die('database not found');
?>
