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

                                    $sql = "UPDATE unit_kerja SET nama = :nama WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':nama', $nama);
                                    $stmt->bindParam(':id', $_POST['id']);
                                    $stmt->execute();
                                    echo '<meta http-equiv="refresh" content="0; url=index.php"><script>alert("Data Telah diubah")</script>';
                                }
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM unit_kerja WHERE id = :id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':id', $id);
                                    $stmt->execute();
                                    $data = $stmt->fetch();
                                }
                                ?>
                                <div class="form-group">
                                    <label for="nama">Unit Kerja</label>
                                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                    <input type="text" class="form-control" id="nama" name="nama" required value="<?= $data['nama'] ?>" placeholder="Unit Kerja">
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