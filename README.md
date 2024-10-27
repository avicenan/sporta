# Sporta - Point of Sales and Management

Aplikasi PoS (Point of Sales) "Sporta" dirancang sebagai sistem manajemen toko
olahraga yang memungkinkan efisiensi dalam transaksi penjualan dan administrasi
produk. Aplikasi ini mendukung dua peran pengguna: Kasir dan Admin, masing-masing
dengan aksesibilitas dan fungsi yang berbeda dalam sistem.

## Pengembang

-   [@avicenan](https://www.github.com/avicenan) - Avicena Naufaldo

## Fitur

-   Registrasi
-   Login
-   Memasukkan Produk ke Tas Belanja
-   Mengurangi Produk di Tas Belanja
-   Membuat Transaksi Penjualan
-   Menambah Produk Baru
-   Melihat Informasi Produk
-   Melakukan Pencarian Produk
-   Mengubah Informasi Produk
-   Menambah Stok Produk
-   Melihat Log Perubahan Stok Produk
-   Menambah Kategori Baru
-   Mengubah Informasi Kategori
-   Melihat Informasi Akun Kasir
-   Melihat Informasi Transaksi Penjualan

## Dokumentasi

[Documentation](https://drive.google.com/file/d/1V3C7rBnsm8z6uv21tZBpDXvUL3sGhdDV/view?usp=drive_link)

## Instalasi

1. Install Sporta with composer

```bash
  composer install
```

2. change .env.example to .env

3. Generate key

```bash
  php artisan key:generate
```

4. configure .env

```bash
  DB_HOST=localhost
  DB_DATABASE=your_data
  DB_USERNAME=root
  DB_PASSWORD=
```

5. migrate table

```bash
  php artisan migrate:fresh --seed
```

6. Run the project

```bash
  php artisan migrate
```

## Tech Stack

**Bahasa Pemrograman:** PHP

**Basis Data:** MySQL

**Framework:** Laravel

**Library:** JQuery, Bootstrap, Material Icons

## Lisensi

The Laravel framework is open-sourced software licensed under the - [MIT](https://choosealicense.com/licenses/mit/)
