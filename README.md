//Janji

Saya Nadzalla Diva Asmara Sutedja dengan Nim 2408095 mengerjakan Tugas Praktikum 5 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan

//Tema Website 

Tema utama dari website ini adalah manajemen data UMKM (Usaha Mikro, Kecil, dan Menengah) dengan tujuan menyediakan satu tempat terpusat untuk mencatat, mengelola, dan menampilkan informasi penting terkait pelaku usaha kecil. Aplikasi ini ditujukan untuk pengguna non-teknis (mis. admin kampus, pendamping UMKM, atau pemilik usaha) sehingga antarmukanya sederhana namun mencakup kebutuhan administrasi dasar: memasukkan data usaha, mengelompokkan produk berdasarkan kategori, melacak stok dan harga produk, serta menampilkan lokasi dan kontak UMKM. Dengan begitu, data UMKM menjadi terdokumentasi, mudah dicari, dan siap untuk keperluan laporan atau promosi.
Secara konsep data, aplikasi ini bekerja dengan tiga entitas utama yang saling berelasi: UMKM, Kategori, dan Produk. Tabel UMKM menyimpan informasi identitas dan kontak UMKM termasuk nama usaha, nama pemilik, alamat lengkap , nomor telepon, dan email. Tabel Kategori menyediakan daftar kategori produk (misalnya Makanan, Minuman, Kerajinan, Pakaian) sehingga produk dapat dikelompokkan dan difilter secara logis. Tabel Produk menyimpan detail setiap item yang dijual: nama produk, harga, jumlah stok, serta dua foreign key yang menghubungkannya ke kategori dan umkm. Relasi ini memastikan integritas data: setiap produk pasti terkait dengan satu UMKM pemilik dan satu kategori.

//Penjelasan Database 

Database pada aplikasi ini dirancang untuk mengelola informasi yang berkaitan dengan UMKM, kategori produk, dan produk yang dijual. Terdapat tiga tabel utama di dalam sistem ini, yaitu tabel umkm, tabel kategori, dan tabel produk. Ketiga tabel ini saling berhubungan dan membentuk relasi one-to-many untuk menjaga konsistensi serta integritas data.

abel umkm berfungsi untuk menyimpan informasi tentang setiap pelaku usaha atau unit bisnis yang terdaftar. Di dalam tabel ini terdapat beberapa kolom penting seperti id_umkm yang menjadi primary key dan berfungsi sebagai identitas unik untuk setiap UMKM. Selain itu, tabel ini juga menyimpan kolom nama_umkm untuk mencatat nama usaha, pemilik untuk nama pemilik UMKM, alamat untuk lokasi usaha, no_telepon sebagai kontak yang bisa dihubungi, serta email untuk alamat surat elektronik dari UMKM tersebut. Dengan adanya tabel ini, setiap entitas usaha dapat diidentifikasi secara unik dan digunakan sebagai acuan bagi tabel lain yang membutuhkan data UMKM.

Selanjutnya, tabel kategori digunakan untuk mengelompokkan produk berdasarkan jenisnya. Tabel ini berisi dua kolom utama, yaitu id_kategori sebagai primary key dan nama_kategori yang menyimpan nama kategori seperti “Makanan”, “Minuman”, “Pakaian”, “Kerajinan”, dan sebagainya. Dengan adanya tabel kategori, produk yang dijual dapat diklasifikasikan dengan lebih terstruktur, sehingga mempermudah proses pencarian dan pengelolaan data.

Tabel terakhir adalah produk, yang menjadi pusat dari sistem karena berisi data setiap barang yang dijual oleh UMKM. Tabel ini memiliki beberapa kolom, antara lain id_produk sebagai primary key, nama_produk untuk nama barang, harga untuk menyimpan harga jual, dan stok untuk jumlah ketersediaan barang. Selain itu, tabel ini juga memiliki dua kolom foreign key, yaitu id_kategori dan id_umkm, yang masing-masing menghubungkan produk ke tabel kategori dan umkm. Dengan relasi ini, setiap produk akan selalu memiliki kategori dan pemilik yang jelas.

Dalam website ini, beberapa data tidak dapat dihapus karena terikat oleh foreign key constraint di database. Misalnya, tabel produk memiliki relasi dengan tabel umkm dan kategori, sehingga data pada tabel umkm atau kategori tidak bisa dihapus jika masih digunakan oleh produk. Aturan ini menjaga integritas data agar tidak terjadi inkonsistensi, seperti produk yang kehilangan referensi UMKM atau kategori yang valid.

//Alur Program

Alur program pada website ini dimulai dari file index.php sebagai halaman utama yang menampilkan navigasi ke tiga menu utama, yaitu UMKM, Kategori, dan Produk. Ketika pengguna memilih salah satu menu, sistem akan memuat tampilan sesuai dengan halaman yang dipilih melalui mekanisme include, yaitu view/umkm_list.php, view/kategori_list.php, atau view/produk_list.php.

Setiap halaman memiliki fitur CRUD (Create, Read, Update, Delete) yang diatur melalui class terpisah di folder class/, yaitu Umkm.php, Kategori.php, dan Produk.php. Class-class ini berfungsi untuk menangani koneksi database, menjalankan query SQL, serta mengembalikan data ke halaman tampilan. Proses input data dilakukan melalui form HTML yang mengirimkan data menggunakan metode POST, kemudian diproses pada file yang sama untuk ditambahkan, diperbarui, atau dihapus dari database.

Selain itu, setiap aksi CRUD menampilkan notifikasi sederhana menggunakan session alert agar pengguna mengetahui hasil dari proses yang dijalankan. Semua tampilan halaman menggunakan struktur HTML dasar, dengan header dan footer yang terpisah untuk menjaga kerapian kode serta memudahkan pengembangan di kemudian hari.  

1. User akan memilih untuk dapat melihat kategori, produk, dan UMKM.
2. Setelah memilih page user dapat melakukan aksi CRUD
3. Data base akan berubah sesuai permintaan user.

//Dokumentasi 

1. CRUD tabel Kategori
https://github.com/user-attachments/assets/ea1ff009-ffef-4c12-9329-d8a870634323
2.  tabel UMKM
https://github.com/user-attachments/assets/7eb06962-ab4a-4132-a37a-b306b2cd357e
3. CRUD tabel Produk
https://github.com/user-attachments/assets/550d9698-4786-4e12-aa58-1c20822b2b75





