<?php
session_start();
include 'koneksi.php';

$nama = '';
$alamat = '';
$no_hp = '';

if (isset($_GET['id'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id='" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($ambil)) {
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $no_hp = $row['no_hp'];
    }
    ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokter Poliklinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
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

        .table {
            background: white;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            border-radius: 10px;
        }

        .btn-info, .btn-danger {
            background: #17A2B8;
            color: white;
            border: 0 none;
            border-radius: 10px;
            cursor: pointer;
            padding: 8px 15px;
            margin-right: 10px;
        }

        .btn-danger:hover, ..btn-danger:focus {
            background: #106286;
        }

        .btn-info:hover, .btn-info:focus {
            background: #0f8b9a;
        }

        .btn-logout {
            background: #DC3545;
            color: white;
            border: 0 none;
            border-radius: 10px;
            cursor: pointer;
            padding: 8px 15px;
            margin-right: 10px;
        }

        .btn-logout:hover, .btn-logout:focus {
            background: #B71B2E;
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
            echo '<a class="btn btn-logout" href="logout.php">Logout</a>';
        }
        ?>
    </div>
</nav>

<div class="container">
    <form class="form row" method="POST" action="" name="myForm" onsubmit="return validate();">
        <?php
        include 'koneksi.php';

        $nama = '';
        $alamat = '';
        $no_hp = '';

        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama = $row['nama'];
                $alamat = $row['alamat'];
                $no_hp = $row['no_hp'];
            }
            ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
        }
        ?>

        <div class="col">
            <label for="inputNama" class="form-label fw-bold">
                Nama Dokter
            </label>
            <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" value="<?php echo $nama ?>">
        </div>
        <div class="col">
            <label for="inputAlamat" class="form-label fw-bold">
                Alamat
            </label>
            <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $alamat ?>">
        </div>
        <div class="col mb-2">
            <label for="inputNo_hp" class="form-label fw-bold">
                Nomor Handphone
            </label>
            <input type="text" class="form-control" name="no_hp" id="inputNo_hp" placeholder="Nomor Handphone" value="<?php echo $no_hp ?>">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Alamat</th>
            <th scope="col">Nomor Handphone</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($mysqli, "SELECT * FROM dokter ORDER BY nama");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
                <td><?php echo $data['no_hp'] ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" href="dokter.php?id=<?php echo $data['id'] ?>">Ubah</a>
                    <a class="btn btn-danger rounded-pill px-3" href="dokter.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<?php
if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE dokter SET 
                                        nama = '" . $_POST['nama'] . "',
                                        alamat = '" . $_POST['alamat'] . "',
                                        no_hp = '" . $_POST['no_hp'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO dokter (nama, alamat, no_hp) 
                                          VALUES (
                                              '" . $_POST['nama'] . "',
                                              '" . $_POST['alamat'] . "',
                                              '" . $_POST['no_hp'] . "'
                                          )");
    }

    echo "<script> 
            document.location='dokter.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE dokter SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='dokter.php';
            </script>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
