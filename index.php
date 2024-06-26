<?php
include 'koneksi.php';

// Mengambil data kelas dari database
$sql = "SELECT * FROM tb_kelas";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Les Private</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-weight: bold;
        font-size: 1.25rem;
    }

    .card-text {
        color: #6c757d;
    }
</style>

<body>

    <section class="hero mt-5">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h1 class="fw-bold">Selamat Datang di Sistem Pendaftaran Les Kami!</h1>
                    <h1 class="fw-bold">Temukan dan Daftar Les yang Anda Butuhkan dengan Mudah!</h1>
                    <h4>Apakah Anda mencari les tambahan untuk meningkatkan kemampuan Anda atau mungkin mencari les khusus untuk anak-anak Anda? Kami menawarkan berbagai macam pilihan les yang dapat Anda pilih sesuai kebutuhan Anda.</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="hero mt-5">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h1 class="fw-bold text-center">Kelas Yang Tersedia</h1>

                    <form class="d-flex mt-5 justify-content-center" role="search" action="index.php" method="get">
                        <input class="form-control me-2" type="search" name="search" placeholder="Cari kelas lainnya" aria-label="Search" style="width: 70%;">
                        <button class="btn btn-outline-success me-3" type="submit">Cari</button>
                        <button class="btn btn-outline-primary" name="show_all" value="1" type="submit">Tampilkan Semua kelas</button>
                    </form>

                    <div class="row justify-content-center mt-4">
                        <?php
                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $search = $_GET['search'];
                            $sql = "SELECT * FROM tb_kelas WHERE nama_kelas LIKE '%$search%' OR jenjang LIKE '%$search%'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                        <div class='col-md-4 mt-3'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$row['nama_kelas']}</h5>
                                    <p class='card-text'>Jenjang: {$row['jenjang']}</p>
                                </div>
                            </div>
                        </div>";
                                }
                            } else {
                                echo "<p class='text-center'>Tidak ada kelas yang ditemukan.</p>";
                            }
                        } elseif (isset($_GET['show_all'])) {
                            $sql = "SELECT * FROM tb_kelas";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                        <div class='col-md-4 mt-3'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$row['nama_kelas']}</h5>
                                    <p class='card-text'>Jenjang: {$row['jenjang']}</p>
                                </div>
                            </div>
                        </div>";
                                }
                            } else {
                                echo "<p class='text-center'>Tidak ada kelas yang tersedia.</p>";
                            }
                        } else {
                            echo "<p class='text-center'>Silakan masukkan kata kunci untuk mencari kelas atau klik 'Tampilkan Semua kelas'.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>