# Laporan Tugas Pertemuan 5: Migrasi Inventory Management System ke Laravel

## 1. Deskripsi Project
Project ini merupakan migrasi aplikasi Inventory Management System dari PHP Native ke framework Laravel v10. Migrasi ini menerapkan arsitektur MVC (Model-View-Controller) dengan fitur utama:
- Manajemen data produk (CRUD).
- Filter kategori dan pencarian data berdasarkan SKU/Nama Produk.
- Pencatatan mutasi stok barang masuk (IN) dan barang keluar (OUT).
- Peringatan stok menipis (minimum stock alert).

---

## 2. Arsitektur MVC & Alur Kerja Project
1. **Route (`routes/web.php`)**: Menerima HTTP Request dari browser dan mengarahkannya ke Controller yang sesuai.
2. **Controller (`app/Http/Controllers/`)**:
   - `ProductController`: Mengelola logika bisnis CRUD produk, validasi input, serta filter/pencarian.
   - `StockMovementController`: Mengelola transaksi pergerakan stok (IN/OUT) serta memperbarui jumlah stok produk secara otomatis.
3. **Model & Database (`app/Models/`)**:
   - `Product`, `Category`, `StockMovement`: Menggunakan Eloquent ORM untuk berinteraksi dengan database MySQL `inventory_db`.
4. **View (`resources/views/`)**:
   - Menggunakan Blade Engine dan Bootstrap 5 untuk menyajikan antarmuka pengguna (`index.blade.php`, `create.blade.php`, `edit.blade.php`, `layouts/app.blade.php`).

---

## 3. Alur Fitur (Form -> Validasi -> Simpan -> Redirect -> Tampil Data)
1. **Membuka Form**: Pengguna menekan tombol `+ Tambah Produk` untuk membuka halaman `products/create`.
2. **Validasi**: Input diperiksa di `ProductController::store()` (memastikan kategori ada, SKU unik, harga/stok bernilai positif).
3. **Simpan**: Setelah lolos validasi, data disimpan ke tabel `products` menggunakan Eloquent `Product::create()`.
4. **Redirect & Tampil Data**: Pengguna diarahkan kembali ke `products.index` disertai pesan sukses, dan data baru langsung muncul di tabel utama.

---

## 4. Instruksi Instalasi & Cara Menjalankan

### Persyaratan Sistem
- PHP >= 8.1
- Composer
- Laragon / XAMPP (MySQL)

### Langkah-Langkah Instalasi
1. Clone / Download Repository:
   ```bash
   git clone <url-repository-kamu>
   cd inventory-laravel
