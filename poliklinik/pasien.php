<!-- Form untuk menambahkan atau mengubah data pasien -->
<form method="POST" action="proses_pasien.php">
    <!-- Potongan kode untuk mengambil data pasien -->
    <?php
    $nama = '';
    $alamat = '';
    $no_hp = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, "SELECT * FROM pasien 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $no_hp = $row['no_hp'];
        }
    ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php
    }
    ?>
    <!-- Input untuk nama, alamat, dan nomor HP -->
    <input type="text" name="nama" value="<?php echo $nama ?>" placeholder="Nama Pasien">
    <input type="text" name="alamat" value="<?php echo $alamat ?>" placeholder="Alamat Pasien">
    <input type="text" name="no_hp" value="<?php echo $no_hp ?>" placeholder="Nomor HP Pasien">
    <input type="submit" value="Submit">
</form>

<!-- Tabel untuk menampilkan data pasien -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM pasien");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td><?php echo $data['no_hp'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="pasien.php?id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="proses_pasien.php?id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Mulai atau lanjutkan sesi
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit; // pastikan untuk keluar dari skrip setelah melakukan redirect
}

// Sekarang, cek apakah pengguna mencoba mengakses halaman yang perlu di-protect
$protected_pages = array("Data Pasien", "Data Dokter", "Periksa");
$current_page = basename($_SERVER['PHP_SELF']); // Ambil nama halaman saat ini

// Jika pengguna mencoba mengakses halaman yang perlu di-protect
if (in_array($current_page, $protected_pages)) {
    // Redirect ke halaman login
    header("Location: login.php");
    exit; // pastikan untuk keluar dari skrip setelah melakukan redirect
}
?>
