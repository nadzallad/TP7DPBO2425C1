<?php
// Ambil semua umkm
$umkm_list = $umkm->getAllUmkm();

// Proses tambah / update / delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add_umkm') {
        $umkm->tambahUmkm($_POST['nama_umkm'], $_POST['pemilik'], $_POST['alamat'],$_POST['no_telepon'], $_POST['email']);
        $_SESSION['pesan'] = "umkm berhasil ditambahkan!";
        header("Location: index.php?page=umkm");
        exit;
    }

    if ($action === 'update_umkm') {
        $umkm->updateUmkm($_POST['id_umkm'], $_POST['nama_umkm'], $_POST['pemilik'], $_POST['alamat'], $_POST['no_telepon'], $_POST['email']);
        $_SESSION['pesan'] = "umkm berhasil diupdate!";
        header("Location: index.php?page=umkm");
        exit;
    }

    if ($action === 'delete_umkm') {
        $umkm->deleteumkm($_POST['id_umkm']);
        $_SESSION['pesan'] = "umkm berhasil dihapus!";
        header("Location: index.php?page=umkm");
        exit;
    }
}
?>

<h3>Daftar UMKM</h3>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama UMKM</th>
        <th>Pemilik</th>
        <th>Alamat</th>
        <th>No. Telepon</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>

    <?php
    require_once 'class/umkm.php';
    $umkm = new Umkm(); 

    $data = $umkm->getAllUmkm();
    if (count($data) > 0):
        foreach ($data as $u):
    ?>
    <tr>
        <td><?= htmlspecialchars($u['nama_umkm']); ?></td>
        <td><?= htmlspecialchars($u['pemilik']); ?></td>
        <td><?= htmlspecialchars($u['alamat']); ?></td>
        <td><?= htmlspecialchars($u['no_telepon']); ?></td>
        <td><?= htmlspecialchars($u['email']); ?></td>
        <td>
            <button onclick="document.getElementById('edit-umkm-<?= $u['id_umkm'] ?>').style.display='block'">Edit</button>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="action" value="delete_umkm">
                <input type="hidden" name="id_umkm" value="<?= $u['id_umkm'] ?>">
                <button type="submit" onclick="return confirm('Yakin ingin menghapus umkm ini?')" style=" background:red; color: white;">Hapus</button>
            </form> 
        </td>
    </tr>
    <?php
        endforeach;
    else:
    ?>
    <tr>
        <td colspan="6" align="center">Belum ada data UMKM.</td>
    </tr>
    <?php endif; ?>
</table>


<h3>Tambah UMKM Baru</h3>
<form method="POST">
    <input type="hidden" name="action" value="add_umkm">
    <div>
        <label>Nama UMKM:</label><br>
        <input type="text" name="nama_umkm" required>
    </div>
    <div>
        <label>Pemilik:</label><br>
        <input type="text" name="pemilik" required>
    </div>
    <div>
        <label>Alamat:</label><br>
        <input type="text" name="alamat" required>
    </div>
    <div>
        <label>No Telepon:</label><br>
        <input type="text" name="no_telepon" required>
    </div>
    <div>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </div>
    <br>
    <button type="submit">Tambah</button>
</form>

<!-- Edit Modal -->
<?php foreach ($umkm_list as $k): ?>
<div id="edit-umkm-<?= $k['id_umkm'] ?>" 
     style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%);
            background:#fff; padding:20px; border:1px solid #ccc; z-index:999;">
    <h3>Edit UMKM</h3>
    <form method="POST">
        <input type="hidden" name="action" value="update_umkm">
        <input type="hidden" name="id_umkm" value="<?= $k['id_umkm'] ?>">

        <div>
            <label>Nama UMKM:</label><br>
            <input type="text" name="nama_umkm" value="<?= htmlspecialchars($k['nama_umkm']) ?>" required>
        </div>
        <div>
            <label>Pemilik:</label><br>
            <input type="text" name="pemilik" value="<?= htmlspecialchars($k['pemilik']) ?>" required>
        </div>
        <div>
            <label>Alamat:</label><br>
            <input type="text" name="alamat" value="<?= htmlspecialchars($k['alamat']) ?>" required>
        </div>
        <div>
            <label>No Telepon:</label><br>
            <input type="text" name="no_telepon" value="<?= htmlspecialchars($k['no_telepon']) ?>" required>
        </div>
        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="<?= htmlspecialchars($k['email']) ?>" required>
        </div>

        <button type="submit">Update</button>
        <button type="button" onclick="document.getElementById('edit-umkm-<?= $k['id_umkm'] ?>').style.display='none'">Batal</button>
    </form>
</div>
<?php endforeach; ?>

