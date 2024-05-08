<!DOCTYPE html>
<html lang="en">
<!-- Hyperlink -->
<?php require_once('../koneksi.php') ?>
<?php include_once('../models/meta.php') ?>
<!-- akhir -->

<body class="sb-nav-fixed">
    <!-- Header Top -->
    <?php include_once('../models/header.php') ?>
    <!-- Akhir -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Sidebar -->
            <?php include_once('../models/sidebar.php') ?>
        </div>
        <!-- dashboard -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                        <form action="" method="post" class="form custom-form">

<?php
if (isset($_POST['tanggal'])) {
    $tanggal = $_POST['tanggal'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi = $_POST['tensi'];
    $keterangan = $_POST['keterangan'];
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];

    $sql = "UPDATE periksa SET tanggal = :tanggal, berat = :berat, tinggi = :tinggi, tensi = :tensi, keterangan = :keterangan, pasien_id = :pasien_id,  dokter_id = :dokter_id WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':tanggal', $tanggal);
    $stmt->bindParam(':berat', $berat);
    $stmt->bindParam(':tinggi', $tinggi);
    $stmt->bindParam(':tensi', $tensi);
    $stmt->bindParam(':keterangan', $keterangan);
    $stmt->bindParam(':pasien_id', $pasien_id);
    $stmt->bindParam(':dokter_id', $dokter_id);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
    echo '<meta http-equiv="refresh" content="0; url=index.php"><script>alert("Data Telah diubah")</script>';
}
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM periksa WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $data = $stmt->fetch();
}
?>
<div class="form-group">
    <label for="tanggal">Tanggal</label>
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data['tanggal'] ?>" required>
</div>
<div class="form-group mt-3">
    <label for="berat">Berat Pasien</label>
    <input type="number" class="form-control" id="berat" name="berat" value="<?= $data['berat'] ?>" required>
</div>
<div class="form-group mt-3">
    <label for="tinggi">Tinggi Pasien</label>
    <input type="number" class="form-control" id="tinggi" name="tinggi" value="<?= $data['tinggi'] ?>" required>
</div>
<div class="form-group mt-3">
    <label for="tensi">Tensi Darah</label>
    <input type="text" class="form-control" id="tensi" name="tensi" value="<?= $data['tensi'] ?>" required>
</div>
<div class="form-group mt-3">
    <label for="keterangan">Keterangan</label>
    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $data['keterangan'] ?>" required>
</div>
<div class="form-group mt-3">
    <label for="pasien_id">Pasien</label>
    <select name="pasien_id" class="form-control" id="pasien_id">
        <option value="" hidden>Pilih Pasien</option>
        <?php
        $sql = "SELECT * FROM pasien";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $kel) {
            $selected = $kel['id'] == $data['pasien_id'] ? "selected" : "";
            echo "<option value='$kel[id]' $selected>$kel[nama]</option>";
        }
        ?>
    </select>
</div>
<div class="form-group mt-3">
    <label for="dokter_id">Dokter</label>
    <select name="dokter_id" class="form-control" id="dokter_id">
        <option value="" hidden>Pilih Dokter</option>
        <?php
        $sql = "SELECT * FROM paramedik";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $kel) {
            $selected = $kel['id'] == $data['dokter_id'] ? "selected" : "";
            echo "<option value='$kel[id]' $selected>$kel[nama]</option>";
        }
        ?>
    </select>
</div>
<button class="btn btn-primary mt-3" type="submit">Update</button>
</form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('../models/footer.php') ?>
        </div>
    </div>
</body>

</html>