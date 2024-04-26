<?php
include '../conn.php';

// Pastikan kode_siswa disediakan dan tidak kosong
if (isset($_GET['kode_siswa']) && !empty($_GET['kode_siswa'])) {
    // Tangkap kode_siswa dari parameter URL
    $kode_siswa = $_GET['kode_siswa'];

    // Buat kueri untuk menghapus siswa berdasarkan kode_siswa
    $sql = "DELETE FROM siswa WHERE kode_siswa = '$kode_siswa'";

    // Eksekusi kueri
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman lihat_siswa.php setelah penghapusan berhasil
        header("Location: lihat_siswa.php?success=1");
        exit();
    } else {
        echo "Error menghapus siswa: " . $conn->error;
    }
} else {
    echo "Kode Siswa tidak valid.";
}

// Menutup koneksi
$conn->close();
