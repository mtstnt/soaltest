# Soal Test

## Cara launch project:
1. Pastikan sudah menginstall `git`, `composer`, sebuah webserver PHP (misal Apache, atau menggunakan XAMPP, bisa juga menggunakan bawaan dari PHP), serta database MySQL di local.
2. Clone repository dari sini. Pakai command: `git clone https://github.com/mtstnt/soaltest.git`. Folder soaltest akan terbuat nantinya.
3. Masuk ke folder soaltest, kemudian ketikkan `composer install` untuk menginstall dependencies dari project ini.
4. Setelah itu, buatlah file `.env` dan copy semua dari file `.env.example`. Ganti beberapa part yang akan digunakan:
   - APP_URL => Ganti dengan url yang nanti akan dipakai utk menjalankan project
   - Setting Database (DB HOST, PORT, USERNAME, PASSWORD, DATABASE).
5. Pastikan MySQL sudah berjalan di background, kemudian jalankan `php artisan migrate` untuk migrasi database sesuai dengan kebutuhan project.
6. Kemudian, ketikkan `php artisan db:seed` untuk seeding database dengan data awal yang disediakan.
7. Setelah selesai, bisa menjalankan projectnya dengan menjalankan `php artisan serve`. Nanti akan diserve di http://localhost:8000.
  Note: Pastikan APP_URL disesuaikan dengan url yang didapat setelah di run.