<?php
date_default_timezone_set("Asia/Jakarta");
$konek = mysqli_connect('localhost', 'root', '123456') or die ('connect failed!!');
/*echo "berhasil terkoneksi.....";
*/
mysqli_select_db($konek, 'ta_latifah') or die('database not found');
?>
