<?php
session_start();
include '../conn.php';

if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
  echo '<script>window.location="../login.php"</script>';
  exit;
}

function getAlternatif($conn)
{
  $alternatif = array();
  $querySiswa = "SELECT * FROM siswa";
  $resultSiswa = $conn->query($querySiswa);
  if ($resultSiswa->rowCount() > 0) {
    while ($rowSiswa = $resultSiswa->fetch(PDO::FETCH_ASSOC)) {
      $alternatif[] = $rowSiswa;
    }
  }
  return $alternatif;
}

function getMatriksAlternatif($conn)
{
  $matriksAlternatif = array();
  $queryKriteria = "SELECT kode_kriteria, nama_kriteria, jenis_kriteria FROM kriteria";
  $resultKriteria = $conn->query($queryKriteria);
  if ($resultKriteria->rowCount() > 0) {
    while ($rowKriteria = $resultKriteria->fetch(PDO::FETCH_ASSOC)) {
      $kodeKriteria = $rowKriteria['kode_kriteria'];
      $jenisKriteria = $rowKriteria['jenis_kriteria'];
      $subkriteria = array();
      $bobotSubkriteria = array();

      $queryPenilaian = "SELECT p.kode_siswa, sk.sub_kriteria, sk.bobot_sub_kriteria 
                         FROM penilaian_siswa p
                         JOIN sub_kriteria sk ON p.id_sub_kriteria = sk.id_sub_kriteria
                         WHERE p.kode_kriteria = :kodeKriteria";
      $stmtPenilaian = $conn->prepare($queryPenilaian);
      $stmtPenilaian->bindParam(':kodeKriteria', $kodeKriteria);
      $stmtPenilaian->execute();
      $resultPenilaian = $stmtPenilaian->fetchAll(PDO::FETCH_ASSOC);
      foreach ($resultPenilaian as $rowPenilaian) {
        $subkriteria[$rowPenilaian['kode_siswa']][] = $rowPenilaian['sub_kriteria'];
        $bobotSubkriteria[$rowPenilaian['kode_siswa']][] = intval($rowPenilaian['bobot_sub_kriteria']);
      }
      $matriksAlternatif[$rowKriteria['nama_kriteria']] = array('subkriteria' => $subkriteria, 'bobot_subkriteria' => $bobotSubkriteria, 'jenis_kriteria' => $jenisKriteria);
    }
  }
  return $matriksAlternatif;
}

try {
  $conn = new PDO("mysql:host=localhost;dbname=mts_psi", 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $alternatif = getAlternatif($conn);
  $matriksAlternatif = getMatriksAlternatif($conn);
  $uniqueKriteria = array_unique(array_keys($matriksAlternatif));

  // Kode HTML untuk tampilan tabel dan sebagainya

} catch (PDOException $e) {
  echo "Koneksi database gagal: " . $e->getMessage();
}

?>

<?php
// Isi dengan kode PHP yang ingin menampilkan data tabel untuk cetak
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Data Hasil Akhir</title>
  <style>
    /* Gaya cetak */
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <section class="section dashboard">
    <div class="row">

      <!-- <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Alternatif (Siswa)</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Kode Siswa</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>No. Telepon</th>
                  <th>Orang Tua / Wali</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($alternatif as $siswa) : ?>
                  <tr>
                    <td><?php echo $siswa['kode_siswa']; ?></td>
                    <td><?php echo $siswa['nama_siswa']; ?></td>
                    <td><?php echo $siswa['kelas']; ?></td>
                    <td><?php echo $siswa['jenis_kelamin']; ?></td>
                    <td><?php echo $siswa['alamat']; ?></td>
                    <td><?php echo $siswa['no_telp']; ?></td>
                    <td><?php echo $siswa['orang_tua_wali']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div> -->

      <!-- <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Alternatif (Kriteria)</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Kode Siswa</th>
                  <?php foreach ($uniqueKriteria as $kriteria) : ?>
                    <th><?php echo $kriteria; ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($alternatif as $siswa) : ?>
                  <tr>
                    <td><?php echo $siswa['kode_siswa']; ?></td>
                    <?php foreach ($uniqueKriteria as $kriteria) : ?>
                      <?php if (isset($matriksAlternatif[$kriteria]['subkriteria'][$siswa['kode_siswa']])) : ?>
                        <td><?php echo implode(", ", $matriksAlternatif[$kriteria]['subkriteria'][$siswa['kode_siswa']]); ?></td>
                      <?php else : ?>
                        <td>-</td>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div> -->

      <!-- <div class="card">
          <div class="card-body">
            <h5 class="card-title">Penilaian Alternatif</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Kode Siswa</th>
                  <?php foreach ($uniqueKriteria as $kriteria) : ?>
                    <th><?php echo $kriteria; ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($alternatif as $siswa) : ?>
                  <tr>
                    <td><?php echo $siswa['kode_siswa']; ?></td>
                    <?php foreach ($uniqueKriteria as $kriteria) : ?>
                      <?php if (isset($matriksAlternatif[$kriteria]['bobot_subkriteria'][$siswa['kode_siswa']])) : ?>
                        <td><?php echo implode(", ", $matriksAlternatif[$kriteria]['bobot_subkriteria'][$siswa['kode_siswa']]); ?></td>
                      <?php else : ?>
                        <td>-</td>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td>Jenis Kriteria</td>
                  <?php foreach ($uniqueKriteria as $kriteria) : ?>
                    <td><?php echo $matriksAlternatif[$kriteria]['jenis_kriteria']; ?></td>
                  <?php endforeach; ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div> -->

      <!-- <?php
            function normalisasiBenefit($nilai, $maxNilai)
            {
              return $nilai / $maxNilai;
            }

            function normalisasiCost($nilai, $minNilai)
            {
              return $minNilai / $nilai;
            }

            $stmt_nilai = $conn->query("SELECT ps.kode_siswa, s.nama_siswa, ps.kode_kriteria, sk.bobot_sub_kriteria AS nilai, k.jenis_kriteria FROM penilaian_siswa ps INNER JOIN siswa s ON ps.kode_siswa = s.kode_siswa INNER JOIN sub_kriteria sk ON ps.id_sub_kriteria = sk.id_sub_kriteria INNER JOIN kriteria k ON ps.kode_kriteria = k.kode_kriteria");

            $stmt_kriteria = $conn->query("SELECT * FROM kriteria");
            $nama_kriteria = array();
            while ($row_kriteria = $stmt_kriteria->fetch(PDO::FETCH_ASSOC)) {
              $nama_kriteria[] = $row_kriteria['nama_kriteria'];
            }
            ?>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Normalisasi Matriks</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th rowspan='2'>Alternatif</th>
                  <?php foreach ($nama_kriteria as $kriteria) : ?>
                    <th><?php echo $kriteria; ?></th>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach ($nama_kriteria as $kriteria) : ?>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $prev_siswa = "";
                $totalNormalisasi = array();
                while ($row_nilai = $stmt_nilai->fetch(PDO::FETCH_ASSOC)) {
                  $kodeSiswa = $row_nilai['kode_siswa'];
                  $namaSiswa = $row_nilai['nama_siswa'];
                  $kodeKriteria = $row_nilai['kode_kriteria'];
                  $nilai = $row_nilai['nilai'];

                  if ($prev_siswa != $kodeSiswa) {
                    echo "<tr>";
                    echo "<td>$kodeSiswa</td>";
                    $prev_siswa = $kodeSiswa;
                  }

                  $maxNilai = $conn->query("SELECT MAX(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                  $minNilai = $conn->query("SELECT MIN(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                  $jenisKriteria = $row_nilai['jenis_kriteria'];
                  if ($jenisKriteria == 'Benefit') {
                    $normalisasi = normalisasiBenefit($nilai, $maxNilai);
                  } else {
                    $normalisasi = normalisasiCost($nilai, $minNilai);
                  }
                  echo "<td>$normalisasi</td>";

                  if (!isset($totalNormalisasi[$kodeKriteria])) {
                    $totalNormalisasi[$kodeKriteria] = 0;
                  }
                  $totalNormalisasi[$kodeKriteria] += $normalisasi;

                  if ($kodeKriteria == end($nama_kriteria)) {
                    echo "</tr>";
                  }
                }
                ?>

              </tbody>
              <tfoot>
                <tr>
                  <td>Total Normalisasi</td>
                  <?php foreach ($totalNormalisasi as $total) : ?>
                    <td><?php echo $total; ?></td>
                  <?php endforeach; ?>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nilai Rata-Rata Kinerja yang Dinormalisasi</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Kode Kriteria</th>
                  <th>Nama Kriteria</th>
                  <th>Nilai Rata-Rata Kinerja</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($totalNormalisasi as $kodeKriteria => $total) {
                  $rataRata = $total / count($nama_kriteria);
                  $namaKriteria = $conn->query("SELECT nama_kriteria FROM kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                  echo "<tr>";
                  echo "<td>$kodeKriteria</td>";
                  echo "<td>$namaKriteria</td>";
                  echo "<td>$rataRata</td>";
                  echo "</tr>";
                }
                ?>
                </tfoot>
            </table>
          </div>
        </div> -->

      <!-- 
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nilai Variasi Preverensi</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Alternatif</th>
                  <?php foreach ($nama_kriteria as $kriteria) : ?>
                    <th><?php echo $kriteria; ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $totalNilai = array_fill_keys($uniqueKriteria, 0);

                foreach ($alternatif as $siswa) {
                  echo "<tr>";
                  echo "<td>" . $siswa['kode_siswa'] . "</td>";

                  foreach ($nama_kriteria as $kriteria) {
                    $kodeKriteria = $conn->query("SELECT kode_kriteria FROM kriteria WHERE nama_kriteria='" . $kriteria . "'")->fetchColumn();
                    $bobotSubkriteria = $conn->query("SELECT sk.bobot_sub_kriteria FROM sub_kriteria sk INNER JOIN penilaian_siswa ps ON sk.id_sub_kriteria = ps.id_sub_kriteria WHERE ps.kode_siswa='" . $siswa['kode_siswa'] . "' AND ps.kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                    $maxBobot = $conn->query("SELECT MAX(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                    $minBobot = $conn->query("SELECT MIN(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                    $jenisKriteria = $conn->query("SELECT jenis_kriteria FROM kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();

                    if ($jenisKriteria == 'Benefit') {
                      $normalisasi = $bobotSubkriteria / $maxBobot;
                    } else {
                      $normalisasi = $minBobot / $bobotSubkriteria;
                    }

                    $rataRata = $totalNormalisasi[$kodeKriteria] / count($nama_kriteria);
                    $nilaiKurangRataRata = $normalisasi - $rataRata;

                    $totalNilai[$kriteria] += $nilaiKurangRataRata;

                    echo "<td>$nilaiKurangRataRata</td>";
                  }

                  echo "</tr>";
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <td>Total</td>
                  <?php foreach ($uniqueKriteria as $kriteria) : ?>
                    <td><?php echo $totalNilai[$kriteria]; ?></td>
                  <?php endforeach; ?>
                </tr>
              </tfoot>
            </table>
          </div>
        </div> -->

      <!-- <div class="card">
          <div class="card-body">
            <h5 class="card-title">Deviasi Nilai Preferensi</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Kriteria</th>
                  <?php foreach ($uniqueKriteria as $kriteria) : ?>
                    <th><?php echo $kriteria; ?></th>
                  <?php endforeach; ?>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Deviasi</td>
                  <?php
                  $totalSemuaDeviasi = 0;
                  foreach ($uniqueKriteria as $kriteria) {

                    $deviasi = 1 - $totalNilai[$kriteria];
                    $totalSemuaDeviasi += $deviasi;
                  ?>
                    <td><?php echo $deviasi; ?></td>
                  <?php } ?>
                  <td><?php echo $totalSemuaDeviasi; ?></td> 
                </tr>
                </tfoot>
            </table>
          </div>
        </div> -->

      <!-- 
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bobot Kriteria</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Kriteria</th>
                  <?php foreach ($uniqueKriteria as $kriteria) : ?>
                    <th><?php echo $kriteria; ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Bobot</td>
                  <?php
                  foreach ($uniqueKriteria as $kriteria) {

                    $bobotKriteria = (1 - $totalNilai[$kriteria]) / $totalSemuaDeviasi;
                  ?>
                    <td><?php echo $bobotKriteria; ?></td>
                  <?php } ?>
                </tr>
                </tfoot>
            </table>
          </div>
        </div> -->
      <!-- 
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Perhitungan PSI</h5>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Alternatif</th>
                  <?php foreach ($uniqueKriteria as $kriteria) : ?>
                    <th><?php echo $kriteria; ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php

                foreach ($alternatif as $siswa) {
                  echo "<tr>";
                  echo "<td>" . $siswa['kode_siswa'] . "</td>";


                  foreach ($nama_kriteria as $kriteria) {
                    $kodeKriteria = $conn->query("SELECT kode_kriteria FROM kriteria WHERE nama_kriteria='" . $kriteria . "'")->fetchColumn();
                    $bobotSubkriteria = $conn->query("SELECT sk.bobot_sub_kriteria FROM sub_kriteria sk INNER JOIN penilaian_siswa ps ON sk.id_sub_kriteria = ps.id_sub_kriteria WHERE ps.kode_siswa='" . $siswa['kode_siswa'] . "' AND ps.kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                    $maxBobot = $conn->query("SELECT MAX(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                    $minBobot = $conn->query("SELECT MIN(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                    $jenisKriteria = $conn->query("SELECT jenis_kriteria FROM kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();

                    if ($jenisKriteria == 'Benefit') {
                      $normalisasi = $bobotSubkriteria / $maxBobot;
                    } else {
                      $normalisasi = $minBobot / $bobotSubkriteria;
                    }


                    $bobotKriteria = (1 - $totalNilai[$kriteria]) / $totalSemuaDeviasi;
                    $psi = $normalisasi * $bobotKriteria;

                    echo "<td>$psi</td>";
                  }

                  echo "</tr>";
                }
                ?>
                </tfoot>
            </table>
          </div>
        </div> -->

      <style>
        .card-title {
          text-align: center;
          font-family: Arial, sans-serif;
          font-size: x-large;
        }

        .container {
          font-size: large;
          float: inline-end;
          padding-right: 40px;
          margin-top: 120px;
        }

        .signature hr {
          width: 110%;
          /* float: inline-end; */
          border: none;
          border-top: 1px solid #000;
        }

        @media print {
          .no-print {
            display: none;
          }
        }
      </style>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Hasil Akhir</h5>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Peringkat</th>
                <th>Kode Siswa</th>
                <th>Nama Siswa</th>
                <th>Nilai PSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Buat array untuk menyimpan nilai PSI setiap siswa
              $nilaiPSI_siswa = array();

              // Hitung nilai PSI untuk setiap siswa
              foreach ($alternatif as $siswa) {
                $kodeSiswa = $siswa['kode_siswa'];
                $namaSiswa = $siswa['nama_siswa'];
                $nilaiPSI = 0;

                // Ambil nilai bobot subkriteria dan hitung nilai PSI
                foreach ($nama_kriteria as $kriteria) {
                  $kodeKriteria = $conn->query("SELECT kode_kriteria FROM kriteria WHERE nama_kriteria='" . $kriteria . "'")->fetchColumn();
                  $bobotSubkriteria = $conn->query("SELECT sk.bobot_sub_kriteria FROM sub_kriteria sk INNER JOIN penilaian_siswa ps ON sk.id_sub_kriteria = ps.id_sub_kriteria WHERE ps.kode_siswa='" . $siswa['kode_siswa'] . "' AND ps.kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                  $maxBobot = $conn->query("SELECT MAX(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                  $minBobot = $conn->query("SELECT MIN(bobot_sub_kriteria) FROM sub_kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();
                  $jenisKriteria = $conn->query("SELECT jenis_kriteria FROM kriteria WHERE kode_kriteria='" . $kodeKriteria . "'")->fetchColumn();

                  if ($jenisKriteria == 'Benefit') {
                    $normalisasi = $bobotSubkriteria / $maxBobot;
                  } else {
                    $normalisasi = $minBobot / $bobotSubkriteria;
                  }

                  // Hitung nilai bobot kriteria
                  $bobotKriteria = (1 - $totalNilai[$kriteria]) / $totalSemuaDeviasi;

                  // Hitung nilai PSI dan tambahkan ke nilai PSI total siswa
                  $nilaiPSI += $normalisasi * $bobotKriteria;
                }

                // Simpan nilai PSI siswa ke dalam array
                $nilaiPSI_siswa[$kodeSiswa] = $nilaiPSI;
              }

              // Urutkan nilai PSI dari tertinggi ke terendah
              arsort($nilaiPSI_siswa);

              // Tampilkan data siswa berdasarkan peringkat
              $peringkat = 1;
              foreach ($nilaiPSI_siswa as $kodeSiswa => $nilaiPSI) {
                $namaSiswa = $conn->query("SELECT nama_siswa FROM siswa WHERE kode_siswa='" . $kodeSiswa . "'")->fetchColumn();
                echo "<tr>";
                echo "<td>$peringkat</td>";
                echo "<td>$kodeSiswa</td>";
                echo "<td>$namaSiswa</td>";
                echo "<td>$nilaiPSI</td>";
                echo "</tr>";
                $peringkat++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="container">
        <p>Tanda Tangan,</p>
        <div class="signature"> <br><br><br>
          <!-- <img src="signature.png" alt="Tanda Tangan"> -->
          <hr>
          <!-- <p>Nama Lengkap</p> -->
          <!-- <p>Jabatan</p> -->
        </div>
      </div>
      <?php
      try {
        $conn = new PDO("mysql:host=localhost;dbname=mts_psi", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Kode PHP untuk perhitungan dan tampilan tabel lainnya

      } catch (PDOException $e) {
        echo "Koneksi database gagal: " . $e->getMessage();
      }
      ?>

      <script>
        window.onload = function() {
          window.print();
        };
      </script>


  </section>
  </main>

</body>

</html>