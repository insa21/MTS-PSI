<?php
include '../conn.php';
session_start();

if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="../login.php"</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil kode siswa dari formulir
  $kode_siswa = $_POST['kode_siswa'];

  // Looping untuk menyimpan sub kriteria yang dipilih untuk setiap kriteria
  foreach ($_POST as $key => $value) {
    // Periksa apakah nama input mengandung 'sub_kriteria_' (yang menunjukkan sub kriteria dipilih)
    if (strpos($key, 'sub_kriteria_') !== false) {
      // Ambil kode kriteria dari nama input
      $kode_kriteria = str_replace('sub_kriteria_', '', $key);

      // Periksa apakah entri sub kriteria sudah ada untuk siswa dan kriteria tertentu
      $queryCheck = "SELECT * FROM penilaian_siswa WHERE kode_siswa = '$kode_siswa' AND kode_kriteria = '$kode_kriteria'";
      $resultCheck = $conn->query($queryCheck);

      if ($resultCheck->num_rows > 0) {
        // Jika sudah ada, update data sub kriteria yang ada
        $queryUpdate = "UPDATE penilaian_siswa SET id_sub_kriteria = '$value' WHERE kode_siswa = '$kode_siswa' AND kode_kriteria = '$kode_kriteria'";
        $conn->query($queryUpdate);
      } else {
        // Jika belum ada, tambahkan data sub kriteria baru
        $queryInsert = "INSERT INTO penilaian_siswa (kode_siswa, kode_kriteria, id_sub_kriteria) VALUES ('$kode_siswa', '$kode_kriteria', '$value')";
        $conn->query($queryInsert);
      }
    }
  }

  // Redirect ke halaman lihat_penilaian.php setelah selesai
  header("Location: lihat_penilaian.php?kode_siswa=$kode_siswa&success=1");
  exit();
} else {
  // Jika tidak ada data POST, kembalikan ke halaman sebelumnya
  header("Location: isi_sub_kriteria.php?kode_siswa=$kode_siswa");
  exit();
}
