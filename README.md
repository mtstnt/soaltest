# Soal Test

## Cara launch project Laravel:
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

## Cara menjalankan query MySQL di SOAL_SQL.sql:
1. Clone repository/download file SOAL_SQL.sql.
2. Buka phpmyadmin jika ada, klik import dan pilih file SOAL_SQL.sql yang tadi didownload.
3. Hasil query akan ditampilkan.

## Cara solve problem 1: Query SQL
- Pertama, dari contoh tabel dapat dilihat bahwa tabel User perlu informasi dari tabel itu sendiri untuk mendapatkan hasil seperti di output yang diharapkan. Jadi, step 1 yaitu menggabungkan tabel User dengan User, pada id = parent. Karena ada row yg memperbolehkan NULL apabila tdk ada pasangan, maka menggunakan LEFT JOIN. LEFT JOIN karena bagian kiri menjadi data utamanya, sedangkan kanan adalah data yang 'ditempelkan'.

## Cara solve problem 2: Login
- Pertama, kita perlu menyusun table yang digunakan untuk menyimpan data User untuk login. Jadi buat migration lewat `php artisan make:migration create_users_table`. Kemudian diisi sesuai soal, membutuhkan username, password. Kemudian migration dijalankan.
- Kemudian, membuat controller dan model untuk table User. Controller yang digunakan yaitu AuthController dan modelnya User. Model User ini menggunakan cara authentication yang disediakan Laravel, yaitu menggunakan class Auth. Class ini memudahkan login, logout, serta maintain session user sekarang.
- Setelah itu, di AuthController membuat 2 function, yaitu login untuk serve page login dan checkLogin untuk periksa login dan redirect. Pada checkLogin, saya menggunakan fitur validasi Laravel untuk filter input kosong, password terlalu panjang (karena akan membebani function hashing). 
- Setelah validasi, saya menggunakan Auth::attempt() untuk login. Ketika login berhasil, class Auth ini akan otomatis menyimpan User session itu.

## Cara solve problem 3: CRUD Master Barang
- Pertama, membuat migration untuk master_barang. Kemudian dijalankan.
- Selanjutnya, menambahkan routes untuk CRUD. Router Laravel menyediakan method Route::resource() utk mendapatkan semua route utk CRUD + form untuk create, edit, dll.
- Kemudian membuat view untuk tampilan tabel dan form tambah dan edit data.
- Untuk cara mengisikan data cukup straightforward di controller BarangController
  
## Cara solve problem 4: Pencatatan Pembelian
- Untuk solve problem ini, saya membuat 2 tabel dengan asumsi bahwa 1 pembelian dapat berupa banyak barang. Jadi, saya membuat tabel Pembelian untuk data total sebuah pembelian, dan Detail Pembelian untuk data rinci pembelian, seperti setiap jenis barang dan jumlahnya.
- Selanjutnya, fokus saya ada di proses Create. Saya membuat form yang dapat menyesuaikan jumlah input secara dinamis, kemudian setiap jenis barang itu diterima oleh Request sebagai array (ada di PembelianController). 
- Untuk memudahkan testing (pada nomor 5) dan supaya code Controller lebih clean, saya membuat class PembelianService untuk secara khusus mengoperasikan penambahan pembelian.
- Dalam penambahan, saya menggunakan DB::transaction karena dlm penambahan saya melakukan query terhadap banyak tabel sekaligus. Dengan transaction, apabila salah 1 saja gagal, maka semua query akan dirollback, sehingga data akan tetap sinkron.

## Cara solve problem 5: Unit Test Modul Pembelian
- Untuk testing ini, saya melakukan testing terhadap function createPembelian di class PembelianService. Hal ini karena semua proses penambahan Pembelian yang berarti ada di PembelianService. 
- Testing dilakukan dengan menginsertkan data-data mock dulu, kemudian baru memanggil function PembelianService dengan parameter yang kita set di testnya.
- Selain itu, agar tidak merubah isi database development, saya menambahkan trait DatabaseTransactions di PembelianTest. Sehingga semua query di test akan dirollback ketika selesai, isi database sebelum test tidak berubah.