<?php
require_once 'config/db.php';

class Umkm {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // CREATE - Tambah UMKM
    public function tambahUmkm($nama, $pemilik, $alamat, $no_telepon, $email) {
        $query = "INSERT INTO umkm (nama_umkm, pemilik, alamat, no_telepon, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nama, $pemilik, $alamat, $no_telepon, $email]);
    }

    // READ - Ambil Semua UMKM
    public function getAllUmkm() {
        $query = "SELECT * FROM umkm";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Ambil UMKM berdasarkan ID
    public function getUmkmById($id) {
        $query = "SELECT * FROM umkm WHERE id_umkm = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE - Ubah Data UMKM
    public function updateUmkm($id, $nama, $pemilik, $alamat, $no_telepon, $email) {
        $query = "UPDATE umkm 
                  SET nama_umkm = ?, pemilik = ?, alamat = ?, no_telepon = ?, email = ? 
                  WHERE id_umkm = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nama, $pemilik, $alamat, $no_telepon, $email, $id]);
    }

    // DELETE - Hapus UMKM

    public function deleteUmkm($id) {
        try {
            $query = "DELETE FROM umkm WHERE id_umkm = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                // Simpan pesan ke session agar bisa ditampilkan setelah redirect
                $_SESSION['pesan'] = "UMKM berhasil dihapus.";
                $_SESSION['tipe'] = "success";
            } else {
                $_SESSION['pesan'] = "Data UMKM tidak ditemukan.";
                $_SESSION['tipe'] = "warning";
            }

        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $_SESSION['pesan'] = "Gagal menghapus: UMKM masih digunakan di tabel Produk.";
                $_SESSION['tipe'] = "danger";
            } else {
                $_SESSION['pesan'] = "Terjadi kesalahan: " . $e->getMessage();
                $_SESSION['tipe'] = "danger";
            }
        }

        // Redirect kembali ke daftar UMKM
        header("Location: ../index.php?page=umkm");
        exit();
    }


}
?>


