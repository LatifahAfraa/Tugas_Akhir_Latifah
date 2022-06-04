<?php

$q=mysqli_query($konek, "DELETE  FROM user WHERE id_user ='$_GET[id_user]'");
if($q)
	echo "<script>alert('Data Berhasil Dihapus'); window.location.href='index.php?page=verifikasi'</script>";
?>