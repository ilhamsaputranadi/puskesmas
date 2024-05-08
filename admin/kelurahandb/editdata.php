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
                            <form action="" method="post">

                                <?php
                                if (isset($_POST['nama'])) {
                                    $nama = $_POST['nama'];
                                    $kec_id = $_POST['kec_id'];

                                    $sql = "UPDATE kelurahan SET nama = :nama, kec_id = :kec_id WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':nama', $nama);
                                    $stmt->bindParam(':kec_id', $kec_id);
                                    $stmt->bindParam(':id', $_POST['id']);
                                    $stmt->execute();
                                    echo '<meta http-equiv="refresh" content="0; url=index.php"><script>alert("Data Telah Diganti")</script>';
                                }
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM kelurahan WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':id', $id);
                                    $stmt->execute();
                                    $data = $stmt->fetch();
                                }
                                ?>
                                <div class="form-group">
                                    <label for="nama">Nama Kelurahan</label>
                                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" required placeholder="Nama Kelurahan">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="kec_id">Kecamatan ID</label>
                                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                    <input type="text" class="form-control" id="kec_id" name="kec_id" value="<?= $data['kec_id'] ?>" required placeholder="Kecamatan ID">
                                </div>
                                <button class="btn btn-primary mt-2" type="submit">Update</button>
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