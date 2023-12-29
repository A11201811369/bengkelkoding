<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Obat Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Add custom styles here */
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(rgba(196, 102, 0, 0.6), rgba(155, 89, 182, 0.6));
            height: 100%;
        }

        .container {
            background: white;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            border-radius: 10px;
            margin: 50px auto;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            padding: 15px;
            border: 1px solid #555;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #333;
        }

        .btn-primary {
            background: #007BFF;
            color: white;
            border: 0 none;
            border-radius: 10px;
            cursor: pointer;
            padding: 12px 20px;
            font-weight: bold;
        }

        .btn-primary:hover, .btn-primary:focus {
            background: #0056b3;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            Sistem Informasi Poliklinik
        </a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation">
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">
                        Home
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Data Master
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="dokter.php?page=dokter">
                                Dokter
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="pasien.php?page=pasien">
                                Pasien
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="obat.php?page=obat">
                                Obat
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="periksa.php?page=periksa">
                        Periksa
                    </a>
                </li>
            </ul>
        </div>
        
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo '<a class="btn btn-danger" href="logout.php">Logout</a>';
        }
        ?>
    </div>
</nav>


<div class="container">
    <h2>Tambah Obat</h2>
    <form class="form" method="POST" action="">
        <div class="mb-2">
            <label for="inputNamaObat" class="form-label fw-bold">
                Nama Obat
            </label>
            <input type="text" class="form-control" name="nama_obat" id="inputNamaObat" placeholder="Nama Obat" required>
        </div>
        <div class="mb-2">
            <label for="inputKemasan" class="form-label fw-bold">
                Kemasan
            </label>
            <input type="text" class="form-control" name="kemasan" id="inputKemasan" placeholder="Kemasan" required>
        </div>
        <div class="mb-2">
            <label for="inputHarga" class="form-label fw-bold">
                Harga
            </label>
            <input type="text" class="form-control" name="harga" id="inputHarga" placeholder="Harga" required>
        </div>
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </form>

    <?php
    // Handle form submission
    if (isset($_POST['simpan'])) {
        include 'koneksi.php'; // Include your database connection file

        $nama_obat = $_POST['nama_obat'];
        $kemasan = $_POST['kemasan'];
        $harga = $_POST['harga'];

        // Insert data into the database
        $query = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama_obat', '$kemasan', '$harga')";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            echo '<div class="alert alert-success mt-3" role="alert">Data obat berhasil ditambahkan!</div>';
        } else {
            echo '<div class="alert alert-danger mt-3" role="alert">Gagal menambahkan data obat. Silakan coba lagi.</div>';
        }

        // Close database connection
        mysqli_close($mysqli);
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
