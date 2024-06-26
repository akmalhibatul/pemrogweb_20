<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $jenjang = $_POST['jenjang'];

    // Query untuk mengupdate data berdasarkan ID
    $sql = "UPDATE tb_kelas SET nama_kelas='$nama_kelas', jenjang='$jenjang' WHERE id_kelas=$id_kelas";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate!";
        header("Location: kelas.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
