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
  <title>Sub Kriteria - MTS NUR IMAN MLANGI</title>

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
              <span>Administrator</span>
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
        <a class="nav-link" data-bs-target="#kriteria-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-checklist"></i><span>kriteria</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="kriteria-nav" class="nav-content" data-bs-parent="#sidebar-nav">
          <li>
            <a href="../data_kriteria.php">
              <i class="bi bi-circle"></i><span>Data Kriteria</span>
            </a>
          </li>
          <li>
            <a href="sub_lihat_kriteria.php" class="active">
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
        <a class="nav-link collapsed" href="../penilaian/lihat_penilaian.php">
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
      <h1>Kriteria</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Kriteria</li>
          <li class="breadcrumb-item active">Data Subkriteria</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card recent-sales overflow-auto">
            <div class="card-body">
              <div class="table-responsive"> <br>
                <button type="button" class="text-white btn btn-info bi bi-plus-lg">
                  <a class="text-white small" href="sub_tambah_kriteria.php">Tambah Subkriteria</a>
                </button><br><br>
                <table class="table table-striped datatable">
                  <!-- <table class="table table-borderless datatable"> -->
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">#</th>
                      <th scope="col">Kode Kriteria</th>
                      <th scope="col">Sub Kriteria</th>
                      <th scope="col">Bobot Kriteria</th>
                      <th scope="col" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Query untuk mengambil data kriteria dari database
                    $query = "SELECT * FROM sub_kriteria";
                    $result = $conn->query($query);

                    // Jika ada data yang ditemukan
                    if ($result->num_rows > 0) {
                      // Inisialisasi nomor urut
                      $nomor = 1;

                      // Perulangan untuk menampilkan data dalam tabel
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='text-center'>{$nomor}</td>";
                        echo "<td>{$row['kode_kriteria']}</td>";
                        echo "<td>{$row['sub_kriteria']}</td>";
                        echo "<td>{$row['bobot_sub_kriteria']}</td>";
                        // echo "<td>{$row['bobot_kriteria']}</td>";
                        // Tombol aksi jika diperlukan
                        echo "<td class='text-center'>";
                        echo "<div class='btn-group' role='group'>";
                        echo "<button class='btn btn-danger delete-kriteria' data-id='" . $row['id_sub_kriteria'] . "'><i class='bi bi-trash'></i></button>";
                        echo "<a href='sub_edit_kriteria.php?id={$row['id_sub_kriteria']}' class='btn btn-warning'><i class='bi bi-pencil'></i></a>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";

                        // Increment nomor urut
                        $nomor++;
                      }
                    } else {
                      // Jika tidak ada data
                      echo "<tr><td colspan='5' class='text-center'>Tidak ada data kriteria.</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div><!-- End Recent Laporan -->
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
  <script>
    document.querySelectorAll('.delete-kriteria').forEach(button => {
      button.addEventListener('click', function() {
        const kodeKriteria = this.getAttribute('data-id');
        Swal.fire({
          title: 'Apakah Anda yakin ingin menghapus Subkriteria?',
          text: 'Menghapus Subkriteria akan mengakibatkan penghapusan semua data terkait dalam tabel penilaian siswa. Apakah Anda yakin ingin melanjutkan?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // Mengarahkan pengguna ke file hapus_kriteria.php
            window.location.href = 'sub_hapus_kriteria.php?id_sub_kriteria=' + kodeKriteria;
          }
        });
      });
    });

    // Menangani notifikasi ketika kriteria berhasil dihapus
    <?php if (isset($_GET['success']) && $_GET['success'] == '1') { ?>
      Swal.fire({
        title: 'Subkriteria berhasil dihapus!',
        icon: 'success',
        confirmButtonText: 'OK'
      });
    <?php } ?>
  </script>

</body>

</html>