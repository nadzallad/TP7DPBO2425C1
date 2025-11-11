<?php
// Ambil semua kategori
$kategori_list = $kategori->getAllKategori();

// Proses tambah / update / delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add_kategori') {
        $kategori->tambahKategori($_POST['nama_kategori'], $_POST['penjelasan']);
        $_SESSION['pesan'] = "Kategori berhasil ditambahkan!";
        header("Location: index.php?page=kategori");
        exit;
    }

    if ($action === 'update_kategori') {
        $kategori->updateKategori($_POST['id_kategori'], $_POST['nama_kategori'], $_POST['penjelasan']);
        $_SESSION['pesan'] = "Kategori berhasil diupdate!";
        header("Location: index.php?page=kategori");
        exit;
    }

    if ($action === 'delete_kategori') {
        $kategori->deleteKategori($_POST['id_kategori']);
        $_SESSION['pesan'] = "Kategori berhasil dihapus!";
        header("Location: index.php?page=kategori");
        exit;
    }
}
?>

<h3>Daftar Kategori UMKM</h3>

<?php if (!empty($kategori_list)): ?>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama Kategori</th>
        <th>Penjelasan</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($kategori_list as $k): ?>
    <tr>
        <td><?= htmlspecialchars($k['nama_kategori']) ?></td>
        <td><?= htmlspecialchars($k['penjelasan']) ?></td>
        <td>
            <button onclick="document.getElementById('edit-kategori-<?= $k['id_kategori'] ?>').style.display='block'">Edit</button>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="action" value="delete_kategori">
                <input type="hidden" name="id_kategori" value="<?= $k['id_kategori'] ?>">
                <button type="submit" onclick="return confirm('Yakin ingin menghapus kategori ini?')" style="color:whit; background: red;">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p><i>Belum ada kategori.</i></p>
<?php endif; ?>

<hr>

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

<!-- Edit Modal -->
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
        <button type="button" onclick="document.getElementById('edit-kategori-<?= $k['id_kategori'] ?>').style.display='none'">Batal</button>
    </form>
</div>
<?php endforeach; ?>
