<?php
if (isset($_POST['username'])) {
    session_start();
    require_once('koneksi.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$username, $password]);
    $row = $stmt->fetch();

    if ($row) {
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $row['nama'];
        echo "<script>alert('Login Berhasil');window.location.href='dashboard.php'</script>";
    } else {
        echo "<script>alert('Email atau Password Salah');window.location.href='login.html'</script>";
    }
}
