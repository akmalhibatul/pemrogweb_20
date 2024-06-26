<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kelas = $_POST['nama_kelas'];
    $jenjang = $_POST['jenjang'];

    // Query untuk menambahkan data
    $sql = "INSERT INTO tb_kelas (nama_kelas, jenjang) VALUES ('$nama_kelas', '$jenjang')";

    if ($conn->query($sql) === TRUE) {
        header("Location: kelas.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
