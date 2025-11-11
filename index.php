<?php
session_start(); // 🔥 WAJIB di baris paling atas!

require_once 'class/kategori.php';
require_once 'class/umkm.php';
require_once 'class/produk.php';

$produk = new Produk();
$kategori = new Kategori();
$umkm = new UMKM();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Katalog UMKM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>
    <main>
        <h2>Katalog UMKM</h2>

        <nav>
            <a href="?page=kategori">Kategori</a> |
            <a href="?page=produk">Produk</a> |
            <a href="?page=umkm">UMKM</a>
        </nav>

        <!-- 🔥 Pesan notifikasi global -->
        <?php if (isset($_SESSION['pesan'])): ?>
            <script>
                alert("<?= addslashes($_SESSION['pesan']); ?>");
            </script>
            <?php unset($_SESSION['pesan']); ?>
        <?php endif; ?>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'kategori') include 'view/kategori_list.php';
            elseif ($page == 'produk') include 'view/produk_list.php';
            elseif ($page == 'umkm') include 'view/umkm_list.php';
        } else {
            echo "<p>Selamat datang di sistem katalog UMKM!</p>";
        }
        ?>
    </main>
    <?php include 'view/footer.php'; ?>
</body>
</html>
