

<?php
        $isi = '';
        $tgl_awal = '';
        $tgl_akhir = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM kegiatan 
            WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $isi = $row['isi'];
                $tgl_awal = $row['tgl_awal'];
                $tgl_akhir = $row['tgl_akhir'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php
        }
        ?>
        <?php
        $result = mysqli_query($mysqli, "SELECT * FROM dokter");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
                <td><?php echo $data['no_hp'] ?></td>
                <td>
                    <a class="btn btn-success rounded-pill px-3" href="index.php?page=dokter&id=<?php echo $data['id'] ?>">Ubah</a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                </td>
            </tr>
        <?php
        }
        ?>
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
