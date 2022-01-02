<?php
require_once dirname(__FILE__) . '/../connection.php';
session_start();

// if (isset($_COOKIE['login_as'])) {
//     $login_as = $_COOKIE['login_as'];
//     $_SESSION['login_as'] = $login_as;
// }
// if (!isset($_SESSION['login_as'])) {
//     header('location: ../index');
// } else {
//     if ($_SESSION['login_as'] != "admin") {
//         header('location: ../index');
//     }
// }

if (!isset($_GET['p'])) {
    $page_no = 1;
} else {
    $page_no = $_GET['p'];
}
if (!isset($_GET['kls'])) {
    $kelas_id = 1;
} else {
    $kelas_id = $_GET['kls'];
}
$records_per_page = 30;
$offset = ($page_no - 1) * $records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$result = $conn->query("SELECT COUNT(*) As total_records FROM guru");
$total_records = $result->fetch_assoc();
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $records_per_page);
$second_last = $total_no_of_pages - 1;
$adjacents = "2";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"></span>
                        <h1 class="title">E-Raport</h1>
                    </a>
                </li>
                <li>
                    <a href="index.html">
                        <span class="icon"><i class='bx bx-grid-alt'></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="hovered">
                    <a href="data-guru.html">
                        <span class="icon"><i class='bx bx-user'></i></span>
                        <span class="title">Data Guru</span>
                    </a>
                </li>
                <li>
                    <a href="data-siswa.html">
                        <span class="icon"><i class='bx bx-user'></i></span>
                        <span class="title">Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="data-kelas.html">
                        <span class="icon"><i class='bx bx-door-open'></i></span>
                        <span class="title">Data Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="data-mapel.html">
                        <span class="icon"><i class='bx bx-book-alt'></i></span>
                        <span class="title">Data Mapel</span>
                    </a>
                </li>
                <li>
                    <a href="data-nilai.html">
                        <span class="icon"><i class='bx bx-book-add'></i></span>
                        <span class="title">Data Nilai</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class='bx bx-exit'></i></span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <!-- main -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <i class='bx bx-menu'></i>
            </div>
            <!-- user -->
            <div class="user">
                <img src="https://blogger.googleusercontent.com/img/a/AVvXsEiXyPi_rGT6jD0HngbJm7ynV-rF3rbepixGAznBNXQteWfrkWk1VvidfrFLeLr3E1slcwmf0jQ3ktsRI1Ga6xMOftHsDC1fbi9Oid8jOz0YX22jl6_i38Y5xbRuLrmoQm2O371YilOhD77YN1xeyibg4_B0qHWhOv24q9DoKzQokmiuruFKmPYKvX1zeA" alt="user">
            </div>
        </div>

        <div class="konten">
            <h2 class="konten_title">
                Tambah Data Guru
            </h2>
            <div class="konten_isi">
                <form class="konten_ubah_nilai">
                    <div class="mb-3">
                        <label for="nipGuru" class="form-label">NIP</label>
                        <input type="text" name="nip" class="form-control" id="nipGuru">
                    </div>
                    <div class="mb-3">
                        <label for="namaGuru" class="form-label">Nama guru</label>
                        <input type="text" name="nama" class="form-control" id="namaGuru">
                    </div>
                    <div class="mb-3">
                        <label for="jkGuru" class="form-label">Jenis kelamin</label>
                        <select class="form-select" id="jkGuru">
                            <option value="Laki-laki" selected>Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalLahirGuru" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggallahir" class="form-control" id="tanggalLahirGuru">
                    </div>
                    <div class="mb-3">
                        <label for="alamatGuru" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamatGuru" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="emailGuru" class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" id="emailGuru" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="noTelpGuru" class="form-label">Nomor Telepon</label>
                        <input type="number" name="telepon" class="form-control" id="noTelpGuru" placeholder="08123456789">
                    </div>
                    <div class="mb-3">
                        <label for="agamaGuru" class="form-label">Agama</label>
                        <select class="form-select" id="agamaGuru">
                            <option value="Buddha" selected>Buddha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Konghuchu">Konghuchu</option>
                            <option value="Kristen">Kristen</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="statusGuru" class="form-label">Status</label>
                        <select class="form-select" id="statusGuru">
                            <option value="Pegawai Negeri Sipil" selected>Pegawai Negeri Sipil</option>
                            <option value="Guru Tidak Tetap">Guru Tidak Tetap</option>
                            <option value="Guru Tetap Yayasan">Guru Tetap Yayasan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="passwordGuru" class="form-label">Password</label>
                        <input type="password" name="passguru" class="form-control" id="passwordGuru">
                    </div>
                    <div class="konten_ubah_nilai_opsi">
                        <a href="data-guru.html"><button class="btn btn-danger">Batalkan</button></a>
                        <a href="data-guru.html"><button type="submit" class="btn btn-success">Tambahkan</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>