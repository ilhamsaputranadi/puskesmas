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
                                if (isset($_POST['kode'])) {
                                    $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?,?,?,?,?,?,?,?)";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->execute([
                                        $_POST['kode'],
                                        $_POST['nama'],
                                        $_POST['tmp_lahir'],
                                        $_POST['tgl_lahir'],
                                        $_POST['gender'],
                                        $_POST['email'],
                                        $_POST['alamat'],
                                        $_POST['kelurahan_id'],
                                    ]);
                                    echo "<script>alert('Data Telah ditambahkan')</script>";
                                    echo '<meta http-equiv="refresh" content="0; url=index.php">';
                                }
                                ?>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="kode">Kode Pasien</label>
                                        <input type="text" class="form-control" id="kode" name="kode" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="nama">Nama Pasien</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="tmp_lahir">Tempat lahir</label>
                                        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="tgl_lahir">Tanggal lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="gender">Gender Pasien</label><br>
                                        <input type="radio" id="genderPR" name="gender" value="0">
                                        <label for="genderPR">Perempuan</label>
                                        <input type="radio" id="genderLK" name="gender" value="1">
                                        <label for="genderLK">Laki-laki</label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Pasien">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
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
                                                echo "<option value='$kel[id]'>$kel[nama]</option>";
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