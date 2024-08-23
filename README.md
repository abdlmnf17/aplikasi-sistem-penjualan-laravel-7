# Setup Aplikasi Penjualan - https://abdulmanap.com

Berikut adalah langkah-langkah untuk menyiapkan aplikasi ini di lingkungan lokal.

## Persyaratan

Pastikan telah menginstal perangkat lunak berikut di sistem:
- [PHP](https://www.php.net/) (versi yang direkomendasikan: 7 - 8)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) atau [MariaDB](https://mariadb.org/) (atau database lain yang didukung)

## Setup Otomatis di Windows

Untuk mempermudah setup aplikasi Laravel, kami menyediakan skrip batch yang akan mengotomatiskan langkah-langkah berikut:
- Menyalin file konfigurasi `.env`
- Menginstal dependensi menggunakan Composer
- Menghasilkan kunci aplikasi Laravel
- Menjalankan migrasi database dan seeder

### Langkah-langkah

1. **Download  / Clone Projek**

   Pastikan  telah mengunduh repositori ini.

2. **Jalankan Skrip Setup**

   Setelah meng-clone repositori ini, buka Command Prompt dan navigasikan ke direktori proyek . Kemudian, jalankan skrip setup dengan mengetikkan:

   ```cmd
   setup.bat

  
