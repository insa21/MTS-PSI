<?php
include '../conn.php';
session_start();

if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="../login.php"</script>';
}

// Periksa apakah parameter kode_siswa ada dalam URL
if (isset($_GET['kode_siswa'])) {
  $kode_siswa = $_GET['kode_siswa'];

  // Query untuk mengambil data penilaian siswa berdasarkan kode siswa
  $queryPenilaian = "SELECT p.kode_siswa, k.nama_kriteria, sk.sub_kriteria
                     FROM penilaian_siswa p
                     JOIN kriteria k ON p.kode_kriteria = k.kode_kriteria
                     JOIN sub_kriteria sk ON p.id_sub_kriteria = sk.id_sub_kriteria
                     WHERE p.kode_siswa = '$kode_siswa'";
  $resultPenilaian = $conn->query($queryPenilaian);

  // Variabel untuk menyimpan data siswa
  $nisn = '';
  $nama_siswa = '';
  $kelas = '';
  $jenis_kelamin = '';
  $alamat = '';
  $no_telp = '';
  $orang_tua_wali = '';

  // Query untuk mengambil data siswa berdasarkan kode siswa
  $querySiswa = "SELECT * FROM siswa WHERE kode_siswa = '$kode_siswa'";
  $resultSiswa = $conn->query($querySiswa);
  if ($resultSiswa->num_rows > 0) {
    $rowSiswa = $resultSiswa->fetch_assoc();
    $nisn = $rowSiswa['nisn'];
    $nama_siswa = $rowSiswa['nama_siswa'];
    $kelas = $rowSiswa['kelas'];
    $jenis_kelamin = $rowSiswa['jenis_kelamin'];
    $alamat = $rowSiswa['alamat'];
    $no_telp = $rowSiswa['no_telp'];
    $orang_tua_wali = $rowSiswa['orang_tua_wali'];
  }
} else {
  // Jika parameter kode_siswa tidak ada, redirect ke halaman sebelumnya
  header("Location: index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Detail Penilaian - MTS NUR IMAN MLANGI</title>

  <link href="../assets/img/logo-mts.png" rel="icon">
  <link href="../assets/template/NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="../assets/template/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/template/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/template/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/template/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/template/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/template/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/template/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="../assets/template/NiceAdmin/assets/css/style.css" rel="stylesheet">

  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<!-- 
* Copyright (c) 2024 Indra Saepudin
*
* Seluruh konten yang tersedia di website ini dilindungi oleh Hak Cipta Indra Saepudin 2024.
*
* Anda diberikan izin untuk menggunakan, menyalin, atau mendistribusikan konten ini untuk tujuan non-komersial,
* asalkan Anda memberikan atribusi kepada Indra Saepudin dan tidak mengubah konten dengan cara apa pun.
*
* Penggunaan konten untuk tujuan komersial hanya diperbolehkan dengan izin tertulis dari Indra Saepudin.
*
* Setiap penggunaan konten dari website ini harus mematuhi semua ketentuan hukum yang berlaku dan tidak boleh
* melanggar hak cipta atau hak-hak lain yang terkait.
*
* Untuk meminta izin penggunaan komersial atau informasi lebih lanjut, silakan hubungi kami di indrasaepudin212@gmail.com.
*/ -->

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="../dashboard.php" class="logo d-flex align-items-center">
        <img src="../assets/img/logo-mts.png" alt="">
        <span class="d-none d-lg-block"> MTS NUR IMAN</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>

        <li class="nav-item dropdown">
        </li>

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/template/NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo $_SESSION['admin']['nama']; ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> <?php echo $_SESSION['admin']['nama']; ?></h6>
              <span>Penilaian</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../editprofile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="../dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#kriteria-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-checklist"></i><span>kriteria</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kriteria-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="../data_kriteria.php">
              <i class="bi bi-circle"></i><span>Data Kriteria</span>
            </a>
          </li>
          <li>
            <a href="../sub_lihat_kriteria.php">
              <i class="bi bi-circle"></i><span>Sub Kriteria (Bobot)</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../siswa/lihat_siswa.php">
          <i class="bi bi-people"></i>
          <span>Siswa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../penilaian/lihat_penilaian.php">
          <i class="bi bi-bar-chart"></i>
          <span>Penilaian</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../perhitungan/perhitungan_psi.php">
          <i class="bi bi-calculator"></i>
          <span>Perhitungan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="../hasil_akhir/hasil_akhir.php">
          <i class="bi bi-clipboard-data"></i>
          <span>Data Hasil Akhir</span>
        </a>
      </li>
    </ul>
  </aside>


  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Detail Penilaian Siswa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Penilaian</li>
          <li class="breadcrumb-item"><a href="#">Data Penilaian Siswa</a></li>
          <li class="breadcrumb-item active"><?php echo $nama_siswa; ?></li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body"><br>
              <h3>Informasi Siswa</h3>
              <table class="table">
                <tr>
                  <td>Kode Siswa</td>
                  <td><?php echo $kode_siswa; ?></td>
                </tr>
                <tr>
                  <td>NISN</td>
                  <td><?php echo $nisn; ?></td>
                </tr>
                <tr>
                  <td>Nama Siswa</td>
                  <td><?php echo $nama_siswa; ?></td>
                </tr>
                <tr>
                  <td>Kelas</td>
                  <td><?php echo $kelas; ?></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td><?php echo $jenis_kelamin; ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td><?php echo $alamat; ?></td>
                </tr>
                <tr>
                  <td>No. Telepon</td>
                  <td><?php echo $no_telp; ?></td>
                </tr>
                <tr>
                  <td>Orang Tua / Wali</td>
                  <td><?php echo $orang_tua_wali; ?></td>
                </tr>
              </table>

              <hr>

              <h3>Detail Penilaian</h3>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kriteria</th>
                      <th scope="col">Sub Kriteria</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($resultPenilaian->num_rows > 0) {
                      $nomor = 1;
                      while ($rowPenilaian = $resultPenilaian->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $nomor . "</td>";
                        echo "<td>" . $rowPenilaian['nama_kriteria'] . "</td>";
                        echo "<td>" . $rowPenilaian['sub_kriteria'] . "</td>";
                        echo "</tr>";
                        $nomor++;
                      }
                    } else {
                      echo "<tr><td colspan='3' class='text-center'>Tidak ada data penilaian untuk siswa ini.</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Bagian Footer dan lainnya di sini -->

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; <?php echo date('Y'); ?> <strong>MTS NUR IMAN MLANGI SLEMAN</strong>.
      <div class="credits">
        Created by <a href="#" target="_blank">Indra Saepudin, S.Kom</a>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/template/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/template/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/template/NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/template/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/template/NiceAdmin/assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/template/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/template/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/template/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/template/NiceAdmin/assets/js/main.js"></script>

</body>

</html>