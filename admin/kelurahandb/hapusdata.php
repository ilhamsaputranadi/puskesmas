<?php
require_once('../koneksi.php');
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM kelurahan WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $pasien = $stmt->fetch();
    if ($pasien) {
        $sql = "DELETE FROM kelurahan WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$_GET['id']]);
        echo "<script>alert('Data Telah dihapus')</script>";
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
    }
}
