@echo off
echo Menyiapkan aplikasi sistem penjualan...
echo.

:: Menyalin .env.example ke .env
echo Menyalin file .env.example ke .env...
copy .env.example .env >nul
if %errorlevel% neq 0 (
    echo Gagal menyalin .env.example ke .env
    exit /b %errorlevel%
)



:: Menghasilkan kunci aplikasi
echo Menghasilkan kunci aplikasi...
php artisan key:generate
if %errorlevel% neq 0 (
    echo Gagal menghasilkan kunci aplikasi
    exit /b %errorlevel%
)

:: Menjalankan migrasi
echo Menjalankan migrasi database dan seeder, harap tunggu...
php artisan migrate --seed
if %errorlevel% neq 0 (
    echo Gagal menjalankan migrasi database
    exit /b %errorlevel%
)

echo.
echo Setup selesai! Aplikasi siap digunakan.
pause
