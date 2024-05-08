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
                        <div class="table-responsive custom-table-responsive">
                                    <?php
                                    if (isset($_POST['tanggal'])) {
                                        $sql = "INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id) VALUES (?,?,?,?,?,?,?)";
                                        $stmt = $dbh->prepare($sql);
                                        $stmt->execute([
                                            $_POST['tanggal'],
                                            $_POST['berat'],
                                            $_POST['tinggi'],
                                            $_POST['tensi'],
                                            $_POST['keterangan'],
                                            $_POST['pasien_id'],
                                            $_POST['dokter_id'],
                                        ]);
                                        echo "<script>alert('Data telah ditambahkan')</script>";
                                        echo '<meta http-equiv="refresh" content="0; url=index.php">';
                                    }
                                    ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" required placeholder="Tanggal Konsultasi">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="berat">Berat Pasien</label>
                                            <input type="number" class="form-control" id="berat" name="berat" required placeholder="Berat Pasien">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="tinggi">Tinggi Pasien</label>
                                            <input type="number" class="form-control" id="tinggi" name="tinggi" required placeholder="Tinggi Pasien">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="tensi">Tensi Darah</label>
                                            <input type="text" class="form-control" id="tensi" name="tensi" required placeholder="Tensi Darah">
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Pasien" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="pasien_id">Nama Pasien</label>
                                            <select name="pasien_id" class="form-control" id="kelurahan_id">
                                                <option value="">Pilih Pasien</option>
                                                <?php
                                                $sql = "SELECT * FROM pasien";
                                                $stmt = $dbh->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach ($result as $pasien) {
                                                    echo "<option value='$pasien[id]'>$pasien[nama]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="dokter_id">Nama Dokter</label>
                                            <select name="dokter_id" class="form-control" id="dokter_id">
                                                <option value="">Pilih Dokter</option>
                                                <?php
                                                $sql = "SELECT * FROM paramedik";
                                                $stmt = $dbh->prepare($sql);
                                                $stmt->execute();
                                                $result = $stmt->fetchAll();
                                                foreach ($result as $dokter) {
                                                    $selected = $dokter['id'] == $data['dokter_id'] ? "selected" : "";
                                                    echo "<option value='$dokter[id]' $selected>$dokter[nama]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary mt-3" type="submit">Tambah</button>
                                    </form>
                                    </div>
                                </div>
                    </div>
                </div>
            </main>
            <?php include_once('../models/footer.php') ?>
        </div>
    </div>
</body>

</html>