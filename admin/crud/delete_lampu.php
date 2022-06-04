<?php

$q=mysqli_query($konek, "DELETE  FROM lampu WHERE id_lampu ='$_GET[id_lampu]'");
if($q)
	echo "<script>alert('Data Berhasil Dihapus'); window.location.href='index.php?page=read_lampu'</script>";
?>