**Saya Muhammad Akhtar Rizki Ramadha dengan NIM 2304742 mengerjakan soal Tugas Praktikum 2 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.**

# Sistem Manajemen Mahasiswa

Aplikasi berbasis web untuk mengelola informasi mahasiswa, pendaftaran mata kuliah, dan catatan akademik. Sistem ini menyediakan antarmuka intuitif bagi administrator untuk memelihara data mahasiswa dan memantau kemajuan akademik mereka.

## 📚 Fitur

### Manajemen Mahasiswa
- Membuat, melihat, mengedit, dan menghapus data mahasiswa
- Menyimpan informasi penting seperti nama, NIM, nomor telepon, dan tanggal masuk
- Melihat detail lengkap mahasiswa

### Manajemen Mata Kuliah
- Menambahkan mahasiswa ke mata kuliah yang tersedia
- Menghapus mahasiswa dari mata kuliah
- Menetapkan dan memperbarui nilai
- Melacak tanggal pendaftaran

### Pelacakan Akademik
- Melihat semua mata kuliah yang diambil oleh mahasiswa
- Memantau nilai di seluruh mata kuliah
- Melihat distribusi mata kuliah per semester

## 🛠️ Teknologi yang Digunakan
- **PHP** untuk pemrosesan sisi server
- **MySQL** untuk penyimpanan data
- **Bootstrap 5** untuk desain antarmuka responsif
- **JavaScript** (Vanilla) untuk fungsionalitas sisi klien

## 📋 Halaman dan Fungsionalitas

### 1. Daftar Mahasiswa (`index.php`)
- Menampilkan seluruh data mahasiswa dalam format tabel
- Menyediakan akses untuk menambah, melihat, mengedit, dan menghapus
- Menampilkan informasi dasar seperti nama, NIM, telepon, dan tanggal masuk

### 2. Detail Mahasiswa (`view.php`)
- Menampilkan informasi lengkap seorang mahasiswa
- Menampilkan semua mata kuliah yang diambil
- Menyediakan tautan cepat untuk mengedit atau mengelola mata kuliah

### 3. Tambah Mahasiswa (`create.php`)
- Formulir untuk menambahkan mahasiswa baru ke sistem
- Mengumpulkan informasi penting

### 4. Edit Mahasiswa (`edit.php`)
- Formulir untuk memperbarui data mahasiswa yang sudah ada
- Diisi otomatis dengan data terkini

### 5. Mata Kuliah Mahasiswa (`courses.php`)
- Menampilkan semua mata kuliah yang diambil oleh mahasiswa
- Menampilkan detail seperti kode, nama, SKS, semester, dan nilai
- Menyediakan opsi untuk menambahkan atau menghapus mata kuliah

### 6. Tambah Mata Kuliah (`add_courses.php`)
- Formulir untuk mendaftarkan mahasiswa ke mata kuliah baru
- Hanya menampilkan mata kuliah yang belum diambil
- Dapat menetapkan nilai saat pendaftaran

## 🚀 Instalasi

### Prasyarat
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache, Nginx, dll)

### Langkah-langkah Instalasi

#### Clone Repositori
```bash
git clone https://github.com/yourusername/student-management-system.git
cd student-management-system
```

#### Setup Database
1. Buat database MySQL baru
2. Impor skema database dari `database/schema.sql`
3. (Opsional) Impor data sampel dari `database/sample_data.sql`

#### Konfigurasi
1. Salin `config.example.php` menjadi `config.php`
2. Perbarui detail koneksi database di `config.php`

```php
// Contoh konfigurasi
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'your_password');
define('DB_NAME', 'student_management');
```

#### Konfigurasi Web Server
- Arahkan root direktori web server ke direktori proyek
- Pastikan server memiliki izin yang sesuai

#### Akses Aplikasi
Buka browser dan arahkan ke URL aplikasi

**Login default (jika autentikasi diaktifkan):**
- Username: `admin`
- Password: `admin123`

## 📊 Skema Database
Sistem ini menggunakan tabel-tabel berikut:

### `students`
- `id` (Primary Key)
- `name`
- `nim` (Nomor Induk Mahasiswa)
- `phone`
- `join_date`

### `courses`
- `id` (Primary Key)
- `course_code`
- `course_name`
- `credits`
- `semester`

### `student_courses` (Tabel Relasi)
- `id` (Primary Key)
- `student_id` (Foreign Key)
- `course_id` (Foreign Key)
- `grade`
- `enrollment_date`

## 🔧 Penggunaan

### Mengelola Mahasiswa
- Klik "Tambah Mahasiswa Baru" di halaman daftar mahasiswa
- Klik tombol "Lihat" untuk melihat detail mahasiswa
- Klik tombol "Edit" untuk memperbarui informasi
- Klik tombol "Hapus" untuk menghapus mahasiswa (dengan konfirmasi)

### Mengelola Mata Kuliah
- Klik tombol "Mata Kuliah" di samping data mahasiswa
- Klik "Tambah Mata Kuliah" untuk mendaftarkan ke mata kuliah baru
- Klik "Hapus" untuk menghapus mata kuliah (dengan konfirmasi)
- Nilai bisa diberikan saat pendaftaran atau diperbarui kemudian

## 🤝 Kontribusi

1. Fork repositori
2. Buat branch fitur (`git checkout -b fitur/fitur-anda`)
3. Commit perubahan Anda (`git commit -m 'Tambah fitur'`)
4. Push ke branch (`git push origin fitur/fitur-anda`)
5. Buka Pull Request

## 📄 Lisensi
Proyek ini dilisensikan di bawah MIT License - lihat file LICENSE untuk detail.
