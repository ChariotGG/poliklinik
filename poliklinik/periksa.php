<div class="form-group mx-sm-3 mb-2">
    <label for="inputPasien" class="sr-only">Pasien</label>
    <select class="form-control" name="id_pasien">
        <?php
        $selected = '';
        $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
        while ($data = mysqli_fetch_array($pasien)) {
            if ($data['id'] == $id_pasien) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
        <?php
        }
        ?>
    </select>
</div>

<?php
$result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
$no = 1;
while ($data = mysqli_fetch_array($result)) {
?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['nama_pasien'] ?></td>
        <td><?php echo $data['nama_dokter'] ?></td>
        <td><?php echo $data['tgl_periksa'] ?></td>
        <td><?php echo $data['catatan'] ?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3" 
            href="index.php?page=periksa&id=<?php echo $data['id'] ?>">
            Ubah</a>
            <a class="btn btn-danger rounded-pill px-3" 
            href="index.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
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
