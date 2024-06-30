<?php
include 'conn.php';
session_start();

if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - MTS NUR IMAN MLANGI</title>

  <link href="assets/img/logo-mts.png" rel="icon">
  <link href="assets/template/NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/template/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/template/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/template/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/template/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/template/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/template/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/template/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/template/NiceAdmin/assets/css/style.css" rel="stylesheet">
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
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo-mts.png" alt="">
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
            <img src="assets/template/NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"> <?php echo $_SESSION['admin']['nama']; ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> <?php echo $_SESSION['admin']['nama']; ?></h6>
              <span>Administrator</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="editprofile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="login.php">
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
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#kriteria-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-checklist"></i><span>kriteria</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kriteria-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="data_kriteria.php">
              <i class="bi bi-circle"></i><span>Data Kriteria</span>
            </a>
          </li>
          <li>
            <a href="kriteria/sub_lihat_kriteria.php">
              <i class="bi bi-circle"></i><span>Sub Kriteria (Bobot)</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="siswa/lihat_siswa.php">
          <i class="bi bi-people"></i>
          <span>Siswa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="penilaian/lihat_penilaian.php">
          <i class="bi bi-bar-chart"></i>
          <span>Penilaian</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="perhitungan/perhitungan_psi.php">
          <i class="bi bi-calculator"></i>
          <span>Perhitungan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="hasil_akhir/hasil_akhir.php">
          <i class="bi bi-clipboard-data"></i>
          <span>Data Hasil Akhir</span>
        </a>
      </li>
    </ul>
  </aside>

  <!-- MASUKAN DATA DASHBOARDNYA  DISINI -->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Siswa Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Siswa Aktif <span>| Hari ini</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query_siswa = "SELECT COUNT(*) AS total FROM siswa";
                        $result_siswa = mysqli_query($conn, $query_siswa);
                        $row_siswa = mysqli_fetch_assoc($result_siswa);
                        echo $row_siswa['total'];
                        ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Siswa Card -->

            <!-- Kriteria Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Data Kriteria <span>| Hari ini</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-list-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query_kriteria = "SELECT COUNT(*) AS total FROM kriteria";
                        $result_kriteria = mysqli_query($conn, $query_kriteria);
                        $row_kriteria = mysqli_fetch_assoc($result_kriteria);
                        echo $row_kriteria['total'];
                        ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Kriteria Card -->

            <!-- Penilaian Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card customers-card customers">
                <div class="card-body">
                  <h5 class="card-title">Data Penilaian <span>| Hari ini</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php
                        $query_penilaian = "SELECT COUNT(*) AS total FROM penilaian_siswa";
                        $result_penilaian = mysqli_query($conn, $query_penilaian);
                        $row_penilaian = mysqli_fetch_assoc($result_penilaian);
                        echo $row_penilaian['total'];
                        ?>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Penilaian Card -->

            <?php include 'data.php' ?>

          </div>
        </div>
    </section>
  </main>

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; <?php echo date('Y'); ?> <strong>MTS NUR IMAN MLANGI SLEMAN</strong>.
      <div class="credits">
        Created by <a href="#" target="_blank">Indra Saepudin, S.Kom</a>
      </div>
    </div>
  </footer>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/template/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/template/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/template/NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/template/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/template/NiceAdmin/assets/vendor/quill/quill.min.js"></script>
  <script src="assets/template/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/template/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/template/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>

  <script src="assets/template/NiceAdmin/assets/js/main.js"></script>

</body>

</html>