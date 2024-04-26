<div class="col-lg-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <div class="table-responsive"> <br>
        <button type="button" class="text-white btn btn-info bi bi-plus-lg">
          <a class="text-white small" href="kriteria/tambah_kriteria.php">Tambah Kriteria</a>
        </button><br><br>
        <table class="table table-striped datatable">
          <thead>
            <tr>
              <th scope="col" class="text-center">#</th>
              <th scope="col">Kode</th>
              <th scope="col">Nama</th>
              <th scope="col">Jenis</th>
              <th scope="col" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Query untuk mengambil data kriteria dari database
            $query = "SELECT kode_kriteria, nama_kriteria, jenis_kriteria FROM kriteria";
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
                echo "<td>{$row['nama_kriteria']}</td>";
                echo "<td>{$row['jenis_kriteria']}</td>";
                // echo "<td>{$row['bobot_kriteria']}</td>";
                // Tombol aksi jika diperlukan
                echo "<td class='text-center'>";
                echo "<div class='btn-group' role='group'>";
                echo "<button class='btn btn-danger delete-kriteria' data-id='" . $row['kode_kriteria'] . "'><i class='bi bi-trash'></i></button>";
                echo "<a href='kriteria/edit_kriteria.php?id={$row['kode_kriteria']}' class='btn btn-warning'><i class='bi bi-pencil'></i></a>";
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

<script>
  document.querySelectorAll('.delete-kriteria').forEach(button => {
    button.addEventListener('click', function() {
      const kodeKriteria = this.getAttribute('data-id');
      Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus kriteria?',
        text: 'Menghapus kriteria akan mengakibatkan penghapusan semua data terkait dalam tabel penilaian siswa. Apakah Anda yakin ingin melanjutkan?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Mengarahkan pengguna ke file hapus_kriteria.php
          window.location.href = 'kriteria/hapus_kriteria.php?kode_kriteria=' + kodeKriteria;
        }
      });
    });
  });

  // Menangani notifikasi ketika kriteria berhasil dihapus
  <?php if (isset($_GET['success']) && $_GET['success'] == '1') { ?>
    Swal.fire({
      title: 'Kriteria berhasil dihapus!',
      icon: 'success',
      confirmButtonText: 'OK'
    });
  <?php } ?>
</script>