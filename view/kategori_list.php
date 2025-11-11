<?php
// Ambil semua data kategori dari database melalui class Kategori
$kategori_list = $kategori->getAllKategori();

// Proses form POST untuk tambah, update, atau delete kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil jenis aksi dari form, default kosong jika tidak ada
    $action = $_POST['action'] ?? '';

    // Jika aksi adalah menambah kategori baru
    if ($action === 'add_kategori') {
        $kategori->tambahKategori($_POST['nama_kategori'], $_POST['penjelasan']); // Panggil method tambahKategori
        $_SESSION['pesan'] = "Kategori berhasil ditambahkan!"; // Simpan pesan sukses di session
        header("Location: index.php?page=kategori"); // Redirect ke halaman kategori
        exit;
    }

    // Jika aksi adalah mengupdate kategori
    if ($action === 'update_kategori') {
        $kategori->updateKategori($_POST['id_kategori'], $_POST['nama_kategori'], $_POST['penjelasan']); // Panggil method updateKategori
        $_SESSION['pesan'] = "Kategori berhasil diupdate!"; // Simpan pesan sukses
        header("Location: index.php?page=kategori"); // Redirect
        exit;
    }

    // Jika aksi adalah menghapus kategori
    if ($action === 'delete_kategori') {
        $kategori->deleteKategori($_POST['id_kategori']); // Panggil method deleteKategori
        $_SESSION['pesan'] = "Kategori berhasil dihapus!"; // Simpan pesan sukses
        header("Location: index.php?page=kategori"); // Redirect
        exit;
    }
}
?>

<!-- Judul halaman daftar kategori -->
<h3>Daftar Kategori UMKM</h3>

<?php if (!empty($kategori_list)): ?>
<!-- Tabel menampilkan semua kategori -->
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama Kategori</th>
        <th>Penjelasan</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($kategori_list as $k): ?>
    <tr>
        <!-- Tampilkan nama kategori dan penjelasan-->
        <td><?= htmlspecialchars($k['nama_kategori']) ?></td>
        <td><?= htmlspecialchars($k['penjelasan']) ?></td>
        <td>
            <!-- Tombol edit untuk menampilkan form edit -->
            <button onclick="document.getElementById('edit-kategori-<?= $k['id_kategori'] ?>').style.display='block'">Edit</button>

            <!-- Form untuk menghapus kategori -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="action" value="delete_kategori">
                <input type="hidden" name="id_kategori" value="<?= $k['id_kategori'] ?>">
                <button type="submit" onclick="return confirm('Yakin ingin menghapus kategori ini?')" 
                        style="color:white; background: red;">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p><i>Belum ada kategori.</i></p>
<?php endif; ?>

<hr>

<!-- Form untuk menambahkan kategori baru -->
<h3>Tambah Kategori Baru</h3>
<form method="POST">
    <input type="hidden" name="action" value="add_kategori">
    <div>
        <label>Nama Kategori:</label><br>
        <input type="text" name="nama_kategori" required>
    </div>
    <div>
        <label>Penjelasan:</label><br>
        <input type="text" name="penjelasan" required>
    </div>
    <button type="submit">Tambah</button>
</form>

<!-- Form edit kategori, muncul saat tombol edit diklik -->
<?php foreach ($kategori_list as $k): ?>
<div id="edit-kategori-<?= $k['id_kategori'] ?>" 
     style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%);
            background:#fff; padding:20px; border:1px solid #ccc; z-index:999;">
    <h3>Edit Kategori</h3>
    <form method="POST">
        <input type="hidden" name="action" value="update_kategori">
        <input type="hidden" name="id_kategori" value="<?= $k['id_kategori'] ?>">
        <div>
            <label>Nama Kategori:</label><br>
            <input type="text" name="nama_kategori" value="<?= htmlspecialchars($k['nama_kategori']) ?>" required>
        </div>
        <div>
            <label>Penjelasan:</label><br>
            <input type="text" name="penjelasan" value="<?= htmlspecialchars($k['penjelasan']) ?>" required>
        </div>
        <button type="submit">Update</button>
        <!-- Tombol batal untuk menutup form -->
        <button type="button" onclick="document.getElementById('edit-kategori-<?= $k['id_kategori'] ?>').style.display='none'">Batal</button>
    </form>
</div>
<?php endforeach; ?>
