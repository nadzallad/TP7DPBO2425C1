CREATE DATABASE db_umkm;
USE db_umkm;

-- ==========================
-- Tabel UMKM
-- ==========================
CREATE TABLE umkm (
    id_umkm INT AUTO_INCREMENT PRIMARY KEY,
    nama_umkm VARCHAR(100) NOT NULL,
    pemilik VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_telepon VARCHAR(20),
    email VARCHAR(100)
);

-- ==========================
-- Tabel Kategori
-- ==========================
CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(200) NOT NULL,
    penjelasan VARCHAR(200) NOT NULL
);

-- ==========================
-- Tabel Produk
-- ==========================
CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga DOUBLE NOT NULL DEFAULT 0,
    stok INT NOT NULL,
    id_umkm INT NOT NULL,
    id_kategori INT NOT NULL,
    FOREIGN KEY (id_umkm) REFERENCES umkm(id_umkm),
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

-- ==========================
-- Data Awal UMKM
-- ==========================
INSERT INTO umkm (nama_umkm, pemilik, alamat, no_telepon, email) VALUES
('Kopi Nusantara', 'Rizal Saputra', 'Jl. Merdeka No. 45, Bandung', '08123456789', 'kopinusantara@gmail.com'),
('Dapur Lezat', 'Ayu Wulandari', 'Jl. Melati No. 12, Yogyakarta', '082223334444', 'dapurlezat@gmail.com'),
('Kerajinan Kayu Lestari', 'Budi Santoso', 'Jl. Raya Sukamaju No. 8, Solo', '081355667788', 'kayulestari@gmail.com');


-- ==========================
-- Data Awal Kategori
-- ==========================
INSERT INTO kategori (nama_kategori, penjelasan) VALUES
('Makanan & Minuman' , 'menyediakan berbagai macam makanan dan minumman mancanegara yang diproduksi oleh waraga lokal'),
('Kerajinan Tangan', 'menjual berbagai barang buatan tangan yang dengan cerita barangnya masing- masing'),
('Fashion',  'pakaian buatan desainer lokal dengan kualitas dan keindahan yang tinggi'),
('Elektronik', 'barang elektronik buatan anak bangsa yang dapat menyaingi pasar diluar negara');

-- ==========================
-- Data Awal Produk
-- ==========================
INSERT INTO produk (nama_produk, harga, stok, id_umkm, id_kategori) VALUES
('Kopi Arabika Premium', 75000,1, 1, 1),
('Nasi Box Spesial Ayam Bakar', 25000, 1, 2, 1),
('Patung Kayu Ukir Bali', 150000, 1, 3, 2),
('Tas Rajut Handmade', 85000, 1, 3, 2),
('Kaos Batik Casual', 120000, 1, 2, 3),
('Kopi Robusta Tubruk', 55000,1, 1, 1);
