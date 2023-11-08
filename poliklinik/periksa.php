<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Periksa Poliklinik</title>
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

        .btn-danger:hover, .btn-danger:focus {
            background: #106286;
        }

        .btn-info:hover, .btn-info:focus {
            background: #0f8b9a;
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
    <form class="form row" method="POST" action="" name="myForm" onsubmit="return validate();">
        <?php
        include 'koneksi.php';

        $id_pasien = '';
        $id_dokter = '';
        $tgl_periksa = '';
        $catatan = '';
        $obat = ' ';

        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM periksa WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $id_pasien = $row['id_pasien'];
                $id_dokter = $row['id_dokter'];
                $tgl_periksa = $row['tgl_periksa'];
                $catatan = $row['catatan'];
                $obat = $row['obat'];
            }
            ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
        }
        ?>
        <div class="col">
            <label for="inputNama" class="form-label fw-bold">
                Nama Pasien
            </label>
            <select class="form-control" name="id_pasien">
                <?php
                $selected = '';
                $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
                while ($data = mysqli_fetch_array($pasien)) {
                    if ($data['id'] == $id_pasien) {
                        $selected = 'selected="selected"';
                    } else {
                        $selected = '';
                    }
                    ?>
                    <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col">
            <label for="inputAlamat" class="form-label fw-bold">
                Nama Dokter
            </label>
            <select class="form-control" name="id_dokter">
                <?php
                $selected = '';
                $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
                while ($data = mysqli_fetch_array($dokter)) {
                    if ($data['id'] == $id_dokter) {
                        $selected = 'selected="selected"';
                    } else {
                        $selected = '';
                    }
                    ?>
                    <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col mb-2">
            <label for="inputNo_hp" class="form-label fw-bold">
                Tanggal Periksa
            </label>
            <input type="date" class="form-control" name="tgl_periksa" id="inputTgl_periksa" placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa; ?>">
        </div>
        <div class="col mb-2">
            <label for="inputNo_hp" class="form-label fw-bold">
                Catatan
            </label>
            <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan" value="<?php echo $catatan; ?>">
        </div>
        <div class="col mb-2">
            <label for="inputNo_hp" class="form-label fw-bold">
                Obat
            </label>
            <input type="text" class="form-control" name="obat" id="inputObat" placeholder="Obat" value="<?php echo $obat; ?>">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Tanggal Periksa</th>
            <th scope="col">Catatan</th>
            <th scope="col">Obat</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['nama_pasien'] ?></td>
                <td><?php echo $data['nama_dokter'] ?></td>
                <td><?php echo $data['tgl_periksa'] ?></td>
                <td><?php echo $data['catatan'] ?></td>
                <td><?php echo $data['obat'] ?></td>
                <td>
                    <a class="btn btn-success rounded-pill px-3" href="periksa.php?page=periksa&id=<?php echo $data['id'] ?>">Ubah</a>
                    <a class="btn btn-danger rounded-pill px-3" href="periksa.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
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
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['catatan'];
    $obat = $_POST['obat'];

    if (!isset($_GET['id'])) {
        $query = "INSERT INTO periksa (id_pasien, id_dokter, tgl_periksa, catatan, obat)
            VALUES ('$id_pasien', '$id_dokter', '$tgl_periksa', '$catatan', '$obat')";
    } else {
        $query = "UPDATE `periksa` SET `id_pasien` = '$id_pasien', `id_dokter` = '$id_dokter', `tgl_periksa` = '$tgl_periksa', `catatan` = '$catatan', `obat` = '$obat'  WHERE `id` = '" . $_GET['id'] . "'";
    }
    $result = mysqli_query($mysqli, $query);
    echo "<script> 
            document.location='periksa.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE periksa SET 
                                status = '" . $_GET['status'] . "' 
                                WHERE
                                id = '" . $_GET['id'] . "'");
    }
    echo "<script> 
            document.location='periksa.php';
            </script>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
