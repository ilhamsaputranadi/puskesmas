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
                                                        <th>Nama</th>
                                                        <th>Gender</th>
                                                        <th>TTL</th>
                                                        <th>Kategori</th>
                                                        <th>Telepon</th>
                                                        <th>Alamat</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $sql = "SELECT paramedik.*, unit_kerja.nama as unit_kerja_nama FROM paramedik INNER JOIN unit_kerja ON paramedik.unit_kerja_id = unit_kerja.id";
                                                    $stmt = $dbh->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll();
                                                    foreach ($result as $row) { ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><?= $row['nama'] ?></td>
                                                            <td><?= $row['gender'] ?></td>
                                                            <td><?= $row['tmp_lahir'] ?>. <?= date('d F Y', strtotime($row['tgl_lahir'])); ?></td>
                                                            <td><?= $row['kategori'] ?></td>
                                                            <td><?= $row['telpon'] ?></td>
                                                            <td><?= $row['alamat'] ?></td>
                                                            <td><?= $row['unit_kerja_nama'] ?></td>
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
