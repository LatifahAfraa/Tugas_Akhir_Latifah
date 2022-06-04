<?php
$konek = mysqli_connect('localhost', 'root', '') or die ('connect failed!!');
/*echo "berhasil terkoneksi.....";
*/
mysqli_select_db($konek, 'db_ta') or die('database not found');
?>
