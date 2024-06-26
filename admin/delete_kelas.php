<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];

    // SQL untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM tb_kelas WHERE id_kelas=$id_kelas";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();

    header("Location: kelas.php");
    exit();
} else {
    echo "ID tidak ditemukan.";
}
