<?php
include '../conn.php';
session_start();

if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="../login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Data Penilaian - MTS NUR IMAN MLANGI</title>

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

  <!-- MASUKAN DATA DASHBOARDNYA  DISINI -->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Data Penilaian Siswa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Penilaian</li>
          <li class="breadcrumb-item active">Data Penilaian Siswa</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped datatable">
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">#</th>
                      <th scope="col" class="text-center">Kode Siswa</th>
                      <?php
                      // Ambil daftar kriteria dari tabel kriteria
                      $queryKriteria = "SELECT kode_kriteria, nama_kriteria FROM kriteria";
                      $resultKriteria = $conn->query($queryKriteria);

                      // Tampilkan setiap kriteria sebagai header dalam tabel
                      if ($resultKriteria->num_rows > 0) {
                        while ($rowKriteria = $resultKriteria->fetch_assoc()) {
                          echo "<th scope='col'>" . $rowKriteria['nama_kriteria'] . "</th>";
                        }
                      }
                      ?>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Ambil data kode siswa dan penilaian siswa
                    $querySiswa = "SELECT kode_siswa FROM siswa";
                    $resultSiswa = $conn->query($querySiswa);

                    if ($resultSiswa->num_rows > 0) {
                      $nomor = 1;
                      while ($rowSiswa = $resultSiswa->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $nomor . "</td>";
                        echo "<td>" . $rowSiswa['kode_siswa'] . "</td>";

                        // Ambil data penilaian siswa untuk setiap kriteria dan tampilkan sebagai isi dalam kolom
                        $resultKriteria->data_seek(0); // Kembalikan pointer hasil kriteria ke awal
                        while ($rowKriteria = $resultKriteria->fetch_assoc()) {
                          $kodeKriteria = $rowKriteria['kode_kriteria'];
                          $queryPenilaian = "SELECT id_sub_kriteria FROM penilaian_siswa WHERE kode_siswa = '" . $rowSiswa['kode_siswa'] . "' AND kode_kriteria = '$kodeKriteria'";
                          $resultPenilaian = $conn->query($queryPenilaian);

                          // Ambil satu subkriteria saja untuk setiap kriteria
                          $subkriteria = "-";
                          if ($resultPenilaian->num_rows > 0) {
                            $rowPenilaian = $resultPenilaian->fetch_assoc();
                            $idSubKriteria = $rowPenilaian['id_sub_kriteria'];
                            $querySubKriteria = "SELECT sub_kriteria FROM sub_kriteria WHERE id_sub_kriteria = $idSubKriteria";
                            $resultSubKriteria = $conn->query($querySubKriteria);
                            if ($resultSubKriteria->num_rows > 0) {
                              $rowSubKriteria = $resultSubKriteria->fetch_assoc();
                              $subkriteria = $rowSubKriteria['sub_kriteria'];
                            }
                          }
                          echo "<td>" . $subkriteria . "</td>";
                        }
                    ?>
                        <td>
                          <div class='btn-group' role='group'>
                            <a href='isi_sub_kriteria.php?kode_siswa=<?php echo $rowSiswa['kode_siswa']; ?>' class='btn btn-primary'><i class='bi bi-pencil'></i></a>
                            <a href='detail_penilaian.php?kode_siswa=<?php echo $rowSiswa['kode_siswa']; ?>' class='btn btn-info'><i class='bi bi-eye'></i></a>
                          </div>
                        </td>
                    <?php
                        echo "</tr>";
                        $nomor++;
                      }
                    } else {
                      echo "<tr><td colspan='" . ($resultKriteria->num_rows + 1) . "' class='text-center'>Tidak ada data penilaian siswa.</td></tr>";
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

  <?php
  // Cek apakah parameter 'success' ada dan bernilai 1
  if (isset($_GET['success']) && $_GET['success'] == '1') {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data penilaian siswa berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    showClass: {
                        popup: 'animate__animated animate__zoomIn'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__zoomOut'
                    }
                });
            });
          </script>";
  }
  ?>

</body>

</html>