<?php
include '../conn.php';

// Pastikan kode_kriteria disediakan dan tidak kosong
if (isset($_GET['kode_kriteria']) && !empty($_GET['kode_kriteria'])) {
  // Tangkap kode_kriteria dari parameter URL
  $kode_kriteria = $_GET['kode_kriteria'];

  // Buat kueri untuk menghapus kriteria berdasarkan kode_kriteria
  $sql = "DELETE FROM Kriteria WHERE kode_kriteria = '$kode_kriteria'";

  // Eksekusi kueri
  if ($conn->query($sql) === TRUE) {
    // Redirect ke halaman lihat_kriteria.php setelah penghapusan berhasil
    header("Location: ../data_kriteria.php?success=1");
    exit();
  } else {
    echo "Error menghapus kriteria: " . $conn->error;
  }
} else {
  echo "Kode Kriteria tidak valid.";
}

// Menutup koneksi
$conn->close();
