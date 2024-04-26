<?php
include '../conn.php';

// Pastikan id_sub_kriteria disediakan dan tidak kosong
if (isset($_GET['id_sub_kriteria']) && !empty($_GET['id_sub_kriteria'])) {
    // Tangkap id_sub_kriteria dari parameter URL
    $id_sub_kriteria = $_GET['id_sub_kriteria'];

    // Buat kueri untuk menghapus kriteria berdasarkan id_sub_kriteria
    $sql = "DELETE FROM sub_kriteria WHERE id_sub_kriteria = '$id_sub_kriteria'";

    // Eksekusi kueri
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman lihat_kriteria.php setelah penghapusan berhasil
        header("Location: sub_lihat_kriteria.php?success=1");
        exit();
    } else {
        echo "Error menghapus subkriteria: " . $conn->error;
    }
} else {
    echo "Kode Subriteria tidak valid.";
}

// Menutup koneksi
$conn->close();
