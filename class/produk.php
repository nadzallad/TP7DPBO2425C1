<?php
require_once 'config/db.php';

class Produk {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // READ - Tampilkan Semua Produk
    public function getAllProducts() {
        $query = "SELECT 
                    p.id_produk,
                    p.nama_produk,
                    p.harga,
                    p.stok,
                    p.id_kategori,
                    p.id_umkm,
                    k.nama_kategori,
                    u.nama_umkm
                  FROM produk p
                  JOIN kategori k ON p.id_kategori = k.id_kategori
                  JOIN umkm u ON p.id_umkm = u.id_umkm
                  ORDER BY p.id_produk ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // DELETE - Hapus Produk (dengan handling error FK)
    public function deleteProduct($id) {
        try {
            $query = "DELETE FROM produk WHERE id_produk = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            // Jika gagal karena foreign key constraint
            if ($e->getCode() == 23000) {
                $_SESSION['pesan'] = "❌ Produk tidak dapat dihapus karena masih digunakan di tabel lain.";
            } else {
                $_SESSION['pesan'] = "Terjadi kesalahan: " . $e->getMessage();
            }
            return false;
        }
    }

    // UPDATE - Ubah Data Produk
    public function updateProduct($id, $nama, $harga, $stok, $kategori_id, $umkm_id) {
        $query = "UPDATE produk 
                  SET nama_produk = ?, harga = ?, stok = ?, id_kategori = ?, id_umkm = ? 
                  WHERE id_produk = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nama, $harga, $stok, $kategori_id, $umkm_id, $id]);
    }

    // CREATE - Tambah Produk
    public function tambahProduk($nama, $harga, $stok, $kategori_id, $umkm_id) {
        $query = "INSERT INTO produk (nama_produk, harga, stok, id_kategori, id_umkm) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nama, $harga, $stok, $kategori_id, $umkm_id]);
    }
}
?>
