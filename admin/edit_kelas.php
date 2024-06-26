<?php
include '../koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];

    // Query untuk mendapatkan data berdasarkan id_kelas
    $sql = "SELECT * FROM tb_kelas WHERE id_kelas=$id_kelas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_kelas = $row['nama_kelas'];
        $jenjang = $row['jenjang'];
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}
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
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-lock fa-fw me-3"></i><span>Logout</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <h1>Edit Kelas</h1>
            <a href="kelas.php" class="btn btn-primary">Kembali</a>
            <div class="card mt-4">
                <div class="card-header">
                    Form Edit kelas
                </div>
                <div class="card-body">
                    <form action="proses_edit.php" method="post">
                        <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>">

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" placeholder="Masukan Nama Kelas" value="<?php echo $nama_kelas; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Jenjang</label>
                            <select class="form-select" name="jenjang" required>
                                <option value="sd" <?php if ($jenjang == 'sd') echo 'selected'; ?>>SD</option>
                                <option value="smp" <?php if ($jenjang == 'smp') echo 'selected'; ?>>SMP</option>
                                <option value="sma" <?php if ($jenjang == 'sma') echo 'selected'; ?>>SMA</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>