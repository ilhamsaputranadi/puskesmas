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
                            <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Kelurahan</th>
                                                        <th>Kecamatan ID</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $sql = "SELECT * FROM kelurahan";
                                                    $stmt = $dbh->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach ($result as $row) { ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><?= $row['nama'] ?></td>
                                                            <td><?= $row['kec_id'] ?></td>
                                                            <td>
                                                                <a href="editdata.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                                                                <a href="hapusdata.php?id=<?= $row['id'] ?>" class="btn btn-danger">Hapus</a>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary mb-3 ms-1"><a href="tambahdata.php" class="text-white" style="text-decoration: none;">Tambah</a></button>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include_once('../models/footer.php') ?>
            </div>
        </div>
    </body>
</html>
