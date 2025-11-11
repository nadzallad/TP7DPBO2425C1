<?php

// Ambil semua data
$produk_list = $produk->getAllProducts();
$umkm_list = $umkm->getAllUmkm();
$kategori_list = $kategori->getAllKategori();

// Proses tambah / update / delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    $id_produk = $_POST['id_produk'] ?? null;
    $nama_produk = $_POST['nama_produk'] ?? '';
    $harga = $_POST['harga'] ?? 0;
    $stok = $_POST['stok'] ?? 0;
    $id_kategori = $_POST['id_kategori'] ?? null;
    $id_umkm = $_POST['id_umkm'] ?? null;

    if ($action === 'add_produk') {
        if ($id_kategori && $id_umkm) {
            $produk->tambahProduk($nama_produk, $harga, $stok, $id_kategori, $id_umkm);
            $_SESSION['pesan'] = "Produk berhasil ditambahkan!";
        } else {
            $_SESSION['pesan'] = "Gagal menambah produk: kategori atau UMKM belum dipilih!";
        }
        header("Location: index.php?page=produk");
        exit;
    }

    if ($action === 'update_produk') {
        if ($id_kategori && $id_umkm) {
            $produk->updateProduct($id_produk, $nama_produk, $harga, $stok, $id_kategori, $id_umkm);
            $_SESSION['pesan'] = "Produk berhasil diupdate!";
        } else {
            $_SESSION['pesan'] = "Gagal update produk: kategori atau UMKM belum dipilih!";
        }
        header("Location: index.php?page=produk");
        exit;
    }

    if ($action === 'delete_produk') {
        $produk->deleteProduct($id_produk);
        $_SESSION['pesan'] = "Produk berhasil dihapus!";
        header("Location: index.php?page=produk");
        exit;
    }
}
?>

<h3>Daftar Produk</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Kategori</th>
        <th>UMKM</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($produk_list)): ?>
        <?php foreach ($produk_list as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nama_produk']); ?></td>
            <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
            <td><?= htmlspecialchars($p['stok']); ?></td>
            <td><?= htmlspecialchars($p['nama_kategori']); ?></td>
            <td><?= htmlspecialchars($p['nama_umkm']); ?></td>
            <td>
                <!-- Tombol Edit buka modal -->
                <button type="button" onclick="document.getElementById('edit-produk-<?= $p['id_produk'] ?>').style.display='block'">
                    Edit
                </button>

                <!-- Tombol Hapus -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete_produk">
                    <input type="hidden" name="id_produk" value="<?= $p['id_produk']; ?>">
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')" style="background:red;border:none;color:white;cursor:pointer;">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="6" align="center">Belum ada produk.</td></tr>
    <?php endif; ?>
</table>

<h3>Tambah Produk Baru</h3>
<form method="POST">
    <input type="hidden" name="action" value="add_produk">
    <div>
        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" required>
    </div>
    <div>
        <label>Harga:</label><br>
        <input type="number" name="harga" min="0" required>
    </div>
    <div>
        <label>Stok:</label><br>
        <input type="number" name="stok" min="0" required>
    </div>
    <div>
        <label>Pilih Kategori:</label><br>
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori_list as $k): ?>
                <option value="<?= $k['id_kategori'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label>Pilih UMKM:</label><br>
        <select name="id_umkm" required>
            <option value="">-- Pilih UMKM --</option>
            <?php foreach ($umkm_list as $u): ?>
                <option value="<?= $u['id_umkm'] ?>"><?= htmlspecialchars($u['nama_umkm']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit">Tambah</button>
</form>

<!-- MODAL EDIT PRODUK -->
<?php foreach ($produk_list as $p): ?>
<div id="edit-produk-<?= $p['id_produk'] ?>" 
     style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%);
            background:#fff; padding:20px; border:1px solid #ccc; z-index:999;">
    <h3>Edit Produk</h3>
    <form method="POST">
        <input type="hidden" name="action" value="update_produk">
        <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">

        <div>
            <label>Nama Produk:</label><br>
            <input type="text" name="nama_produk" value="<?= htmlspecialchars($p['nama_produk']) ?>" required>
        </div>
        <div>
            <label>Harga:</label><br>
            <input type="number" name="harga" min="0" value="<?= htmlspecialchars($p['harga']) ?>" required>
        </div>
        <div>
            <label>Stok:</label><br>
            <input type="number" name="stok" min="0" value="<?= htmlspecialchars($p['stok']) ?>" required>
        </div>
        <div>
            <label>Pilih Kategori:</label><br>
            <select name="id_kategori" required>
                <?php foreach ($kategori_list as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori'] == $p['id_kategori'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($k['nama_kategori']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Pilih UMKM:</label><br>
            <select name="id_umkm" required>
                <?php foreach ($umkm_list as $u): ?>
                    <option value="<?= $u['id_umkm'] ?>" <?= $u['id_umkm'] == $p['id_umkm'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($u['nama_umkm']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Update</button>
        <button type="button" onclick="document.getElementById('edit-produk-<?= $p['id_produk'] ?>').style.display='none'">Batal</button>
    </form>
</div>
<?php endforeach; ?>
