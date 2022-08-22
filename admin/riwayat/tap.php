<?php
require "../../koneksi/koneksi.php";
$no = 0;
$query = mysqli_query($konek, "SELECT *from log_scan ORDER BY created_at DESC LIMIT 20");
while ($row = mysqli_fetch_array($query)) {
?>
    <tr>
        <td><?php echo $no = $no + 1; ?></td>
        <td><?php echo $row['rfid']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
<?php } ?>