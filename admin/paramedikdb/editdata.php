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
                            <form action="" method="post" class="form custom-class">

                                <?php
                                if (isset($_POST['nama'])) {
                                    $nama = $_POST['nama'];
                                    $gender = $_POST['gender'];
                                    $tmp_lahir = $_POST['tmp_lahir'];
                                    $tgl_lahir = $_POST['tgl_lahir'];
                                    $kategori = $_POST['kategori'];
                                    $telpon = $_POST['telpon'];
                                    $alamat = $_POST['alamat'];
                                    $unit_kerja_id = $_POST['unit_kerja_id'];

                                    $sql = "UPDATE paramedik SET nama = :nama, gender = :gender, tmp_lahir = :tmp_lahir, tgl_lahir = :tgl_lahir, kategori = :kategori, telpon = :telpon,  alamat = :alamat, unit_kerja_id = :unit_kerja_id WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':nama', $nama);
                                    $stmt->bindParam(':gender', $gender);
                                    $stmt->bindParam(':tmp_lahir', $tmp_lahir);
                                    $stmt->bindParam(':tgl_lahir', $tgl_lahir);
                                    $stmt->bindParam(':kategori', $kategori);
                                    $stmt->bindParam(':telpon', $telpon);
                                    $stmt->bindParam(':alamat', $alamat);
                                    $stmt->bindParam(':unit_kerja_id', $unit_kerja_id);
                                    $stmt->bindParam(':id', $_POST['id']);
                                    $stmt->execute();
                                    echo '<meta http-equiv="refresh" content="0; url=index.php"><script>alert("Data telah diubah")</script>';
                                }
                                if (isset($_GET['id'])) {
                                    $sql = "SELECT * FROM paramedik WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':id', $_GET['id']);
                                    $stmt->execute();
                                    $data = $stmt->fetch();
                                }
                                ?>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                    <input type="text" class="form-control" id="nama" name="nama" required value="<?= $data['nama'] ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="gender">Gender</label>
                                    <input type="text" class="form-control" id="gender" name="gender" required value="<?= $data['gender'] ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="tmp_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" required value="<?= $data['tmp_lahir'] ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required value="<?= $data['tgl_lahir'] ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" class="form-control" id="kategori">
                                        <option value="" hidden>Pilih Kategori</option>
                                        <?php
                                        try {
                                            $sql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS 
                                            WHERE TABLE_SCHEMA = 'dbpuskesmas' 
                                            AND TABLE_NAME = 'paramedik' 
                                            AND COLUMN_NAME = 'kategori'";
                                            $stmt = $dbh->prepare($sql);
                                            $stmt->execute();
                                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                            if ($result) {
                                                $type = $result['COLUMN_TYPE'];
                                                preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
                                                $enums = explode("','", $matches[1]);

                                                foreach ($enums as $enum) {
                                                    $selected = ($enum == $data['kategori']) ? 'selected' : '';
                                                    echo "<option value='$enum' $selected>$enum</option>";
                                                }
                                            }
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="telpon">Telepon</label>
                                    <input type="number" class="form-control" id="telpon" name="telpon" required value="<?= $data['telpon'] ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required value="<?= $data['alamat'] ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="unit_kerja_id">Unit Kerja</label>
                                    <select name="unit_kerja_id" class="form-control" id="unit_kerja_id">
                                        <option value="" hidden>Pilih Unit</option>
                                        <?php
                                        $sql = "SELECT * FROM unit_kerja";
                                        $stmt = $dbh->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        foreach ($result as $unit) {
                                            $selected = $unit['id'] == $data['unit_kerja_id'] ? "selected" : "";
                                            echo "<option value='$unit[id]' $selected>$unit[nama]</option>";
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