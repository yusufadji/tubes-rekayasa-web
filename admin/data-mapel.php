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
                    <a href="../index">
                        <span class="icon"><i class='bx bx-grid-alt'></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="data-guru">
                        <span class="icon"><i class='bx bx-user'></i></span>
                        <span class="title">Data Guru</span>
                    </a>
                </li>
                <li>
                    <a href="data-siswa">
                        <span class="icon"><i class='bx bx-user'></i></span>
                        <span class="title">Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="data-kelas">
                        <span class="icon"><i class='bx bx-door-open'></i></span>
                        <span class="title">Data Kelas</span>
                    </a>
                </li>
                <li class="hovered">
                    <a href="data-mapel">
                        <span class="icon"><i class='bx bx-book-alt'></i></span>
                        <span class="title">Data Mapel</span>
                    </a>
                </li>
                <li>
                    <a href="data-nilai">
                        <span class="icon"><i class='bx bx-book-add'></i></span>
                        <span class="title">Data Nilai</span>
                    </a>
                </li>
                <li>
                    <a href="../logout">
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
            <!-- search -->
            <div class="search">
                <label>
                    <input type="text" name="search" id="search" placeholder="Search here">
                    <i class='bx bx-search'></i>
                </label>
            </div>
            <!-- user -->
            <div class="user">
                <img src="https://blogger.googleusercontent.com/img/a/AVvXsEiXyPi_rGT6jD0HngbJm7ynV-rF3rbepixGAznBNXQteWfrkWk1VvidfrFLeLr3E1slcwmf0jQ3ktsRI1Ga6xMOftHsDC1fbi9Oid8jOz0YX22jl6_i38Y5xbRuLrmoQm2O371YilOhD77YN1xeyibg4_B0qHWhOv24q9DoKzQokmiuruFKmPYKvX1zeA" alt="user">
            </div>
        </div>

        <!-- card -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <?php
                    $result_mapel = $conn->query("SELECT * FROM mata_pelajaran LIMIT $records_per_page OFFSET $offset");
                    if ($result_mapel && $result_mapel->num_rows > 0) {
                        $result_jml = $conn->query("SELECT COUNT(*) AS total_mapel FROM mata_pelajaran");
                        $jml = $result_jml->fetch_assoc();
                        echo "<div class='numbers'>${jml['total_mapel']}</div>";
                    }
                    ?>
                    <div class="cardName">Mata pelajaran</div>
                </div>
                <div class="iconBx">
                    <i class='bx bx-book-alt'></i>
                </div>
            </div>
        </div>

        <div class="konten">
            <h2 class="konten_title">
                Data Mapel
            </h2>
            <div class="konten_isi">
                <div class="konten_pengaturan">
                    <a href="tambah-data-mapel"><button type="button" class="btn btn-success">Tambah
                            mapel</button></a>
                </div>
                <div class="konten_table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata pelajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result_mapel = $conn->query("SELECT * FROM mata_pelajaran LIMIT $records_per_page OFFSET $offset");
                            if ($result_mapel && $result_mapel->num_rows > 0) {
                                $no = 1;
                                while ($row = $result_mapel->fetch_assoc()) {
                                    echo "
                                <tr>
                                    <td>$no</td>
                                    <td>${row['nama_mapel']}</td>
                                    <td class='aksi'>
                                        <a href='ubah-data-mapel?id_mapel=${row['id_mapel']}'><button type='button' data-bs-toggle='tooltip' class='btn btn-primary btn-sm' title='Ubah'><i class='bx bx-pencil'></i></button></a>
                                        <a href='hapus-data-mapel?id_mapel=${row['id_mapel']}'><button type='button' data-bs-toggle='tooltip' class='btn btn-danger btn-sm' title='Hapus'><i class='bx bx-trash'></i></button></a>
                                    </td>
                                </tr>
                                ";
                                    $no++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="konten_nav">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>