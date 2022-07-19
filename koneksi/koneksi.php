<?php
date_default_timezone_set("Asia/Jakarta");

$konek = mysqli_connect('db-ta.cs50f4xozssp.us-east-1.rds.amazonaws.com', 'admin', 'admin12345') or die ('connect failed!!');
/*echo "berhasil terkoneksi.....";
*/
mysqli_select_db($konek, 'db_ta') or die('database not found');
?>
