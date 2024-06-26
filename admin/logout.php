<?php
session_start(); // Memulai sesi

// Menghancurkan sesi
session_destroy();

// Mengarahkan kembali ke halaman login atau halaman lain
header("Location: ../login.php");
exit();
