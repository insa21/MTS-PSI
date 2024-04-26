<?php

// Fungsi untuk menghitung nilai PSI
function hitungPSI($nilaiNormalisasi, $bobot)
{
    // Pastikan jumlah nilai normalisasi dan bobot sama
    if (count($nilaiNormalisasi) != count($bobot)) {
        return "Jumlah nilai normalisasi dan bobot harus sama";
    }

    $jumlahVariabel = count($nilaiNormalisasi);
    $totalPSI = 0;

    // Hitung nilai PSI
    for ($i = 0; $i < $jumlahVariabel; $i++) {
        $totalPSI += $nilaiNormalisasi[$i] * $bobot[$i];
    }

    return $totalPSI;
}

// Contoh data nilai normalisasi dan bobot
$nilaiNormalisasi = array(0.8, 0.7, 0.9); // Contoh nilai normalisasi
$bobot = array(0.3, 0.4, 0.3); // Contoh bobot

// Hitung PSI
$nilaiPSI = hitungPSI($nilaiNormalisasi, $bobot);
echo "Nilai PSI: " . $nilaiPSI;
