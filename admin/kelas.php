<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT id_kelas, nama_kelas, jenjang FROM tb_kelas";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3">
                    <h1>Les Private</h1>
                    <a href="index.php" class="list-group-item list-group-item-action py-2 ripple " aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                    </a>
                    <a href="kelas.php" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Kelas</span>
                    </a>
                    <a href="logout.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Logout</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <h1>Kelas</h1>
            <a href="tambah_kelas.php" class="btn btn-primary">Tambah Kelas</a>
            <form class="d-flex mt-5" role="search" action="kelas.php" method="get">
                <input class="form-control me-2" type="search" name="search" placeholder="Cari kelas lainnya" aria-label="Search" style="width: 70%;">
                <button class="btn btn-outline-success me-3" type="submit">Cari</button>
                <a href="kelas.php" class="btn btn-outline-primary">Tampilkan Semua kelas</a>
            </form>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kelas</th>
                        <th scope="col">Jenjang</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';

                    $search = "";
                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                    }

                    // Query untuk pencarian data
                    if ($search != "") {
                        $sql = "SELECT id_kelas, nama_kelas, jenjang FROM tb_kelas WHERE nama_kelas LIKE '%$search%' OR jenjang LIKE '%$search%'";
                    } else {
                        $sql = "SELECT id_kelas, nama_kelas, jenjang FROM tb_kelas";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data dari setiap row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row["id_kelas"] . "</th>";
                            echo "<td>" . $row["nama_kelas"] . "</td>";
                            echo "<td>" . $row["jenjang"] . "</td>";
                            echo "<td>
                                <a href='edit_kelas.php?id_kelas=" . $row["id_kelas"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_kelas.php?id_kelas=" . $row["id_kelas"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Tidak ada data</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>