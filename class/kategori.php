<?php
require_once 'config/db.php';

class Kategori {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // CREATE - Tambah Kategori
    public function tambahKategori($nama, $penjelasan) {
        $query = "INSERT INTO kategori (nama_kategori, penjelasan) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nama, $penjelasan]);
    }

    // READ - Ambil Semua Kategori
    public function getAllKategori() {
        $query = "SELECT * FROM kategori";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Ambil Satu Kategori berdasarkan ID
    public function getKategoriById($id) {
        $query = "SELECT * FROM kategori WHERE id_kategori = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE - Ubah Kategori
    public function updateKategori($id, $nama, $penjelasan) {
        $query = "UPDATE kategori 
                  SET nama_kategori = ?, penjelasan = ?
                  WHERE id_kategori = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nama, $penjelasan, $id]);
    }

    // DELETE - Hapus Kategori
    public function deleteKategori($id) {
    try {
        $query = "DELETE FROM kategori WHERE id_kategori = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
   if ($stmt->rowCount() > 0) {
            // Simpan pesan ke session agar bisa ditampilkan setelah redirect
            $_SESSION['pesan'] = "Kategori berhasil dihapus.";
            $_SESSION['tipe'] = "success";
        } else {
            $_SESSION['pesan'] = "Data Kategori tidak ditemukan.";
            $_SESSION['tipe'] = "warning";
        }

    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $_SESSION['pesan'] = "Gagal menghapus: Kategori masih digunakan di tabel Produk.";
            $_SESSION['tipe'] = "danger";
        } else {
            $_SESSION['pesan'] = "Terjadi kesalahan: " . $e->getMessage();
            $_SESSION['tipe'] = "danger";
        }
    }

    // Redirect kembali ke daftar UMKM
    header("Location: ../index.php?page=kategori");
    exit();
    }
}


?>


