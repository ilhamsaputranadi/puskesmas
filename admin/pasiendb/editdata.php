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
                                if (isset($_POST['nama'])) {
                                    $kode = $_POST['kode'];
                                    $nama = $_POST['nama'];
                                    $tmp_lahir = $_POST['tmp_lahir'];
                                    $tgl_lahir = $_POST['tgl_lahir'];
                                    $gender = $_POST['gender'];
                                    $email = $_POST['email'];
                                    $alamat = $_POST['alamat'];
                                    $kelurahan_id = $_POST['kelurahan_id'];

                                    $sql = "UPDATE pasien SET kode = :kode, nama = :nama, tmp_lahir = :tmp_lahir, tgl_lahir = :tgl_lahir, gender = :gender, email = :email,  alamat = :alamat,  kelurahan_id = :kelurahan_id WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':kode', $kode);
                                    $stmt->bindParam(':nama', $nama);
                                    $stmt->bindParam(':tmp_lahir', $tmp_lahir);
                                    $stmt->bindParam(':tgl_lahir', $tgl_lahir);
                                    $stmt->bindParam(':gender', $gender);
                                    $stmt->bindParam(':alamat', $alamat);
                                    $stmt->bindParam(':email', $email);
                                    $stmt->bindParam(':alamat', $alamat);
                                    $stmt->bindParam(':kelurahan_id', $kelurahan_id);
                                    $stmt->bindParam(':id', $_POST['id']);
                                    $stmt->execute();
                                    echo '<meta http-equiv="refresh" content="0; url=index.php"><script>alert("Data Telah diganti")</script>';
                                }
                                if (isset($_GET['id'])) {
                                    $sql = "SELECT * FROM pasien WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':id', $_GET['id']);
                                    $stmt->execute();
                                    $data = $stmt->fetch();
                                }
                                ?>
                                <div class="form-group">
                                    <label for="kode">Kode Pasien</label>
                                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $data['nama'] ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="nama">Nama Pasien</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required value="<?= $data['nama'] ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="tmp_lahir">Tempat lahir</label>
                                    <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" value="<?= $data['tmp_lahir'] ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="tgl_lahir">Tanggal lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="gender">Gender Pasien</label><br>
                                    <input type="radio" id="genderPR" name="gender" <?= $data['gender'] == 0 ? "checked" : "" ?> value="0">
                                    <label for="genderPR">Perempuan</label>
                                    <input type="radio" id="genderLK" name="gender" <?= $data['gender'] == 1 ? "checked" : "" ?> value="1">
                                    <label for="genderLK">Laki-laki</label>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>" required><?= $data['alamat'] ?></textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="kelurahan_id">Kelurahan</label>
                                    <select name="kelurahan_id" class="form-control" id="kelurahan_id">
                                        <option value="">Pilih Kelurahan</option>
                                        <?php
                                        $sql = "SELECT * FROM kelurahan";
                                        $stmt = $dbh->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        foreach ($result as $kel) {
                                            $selected = $kel['id'] == $data['kelurahan_id'] ? "selected" : "";
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