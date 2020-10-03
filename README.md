# POPOJI
Free Engine Management System - Indonesia
Contact : info@popojicms.org

## Kebutuhan Server
- PHP >= 7.2
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Curl PHP Extension
- Mysql PHP Extension
- Exif PHP Extension
- Fileinfo PHP Extension

## Cara Instalasi POPOJI lewat zip file

1. Extract file popoji.v.x.x.x.zip di directory web Anda.
2. Buatlah database baru dengan collation utf8mb4_unicode_ci yang nantinya sebagai tempat instalasi tabel-tabel.
3. Melalui browser Anda, masuk ke alamat web dimana file popoji.v.x.x.x.zip tadi diextract.
4. Ikuti petunjuk instalasi dengan benar dan pastikan semua kebutuhan sistem terpenuhi sebelum instalasi.
5. Jika instalasi berhasil, hapuslah atau rename file install.php dan hapus README file ini dari directory web Anda.
6. POPOJI siap untuk digunakan.
7. Semua konfigurasi engine ada pada file po-includes/.env

## Cara Instalasi POPOJI lewat composer

1. Extract file popoji.v.x.x.x-composer.zip di directory web Anda.
2. Buatlah database baru dengan collation utf8mb4_unicode_ci yang nantinya sebagai tempat instalasi tabel-tabel.
3. Buka command line dan masuk ke path hasil ekstraksi tadi /path/po-includes kemudian jalankan ``composer install`` atau ``composer require``
4. Setalah proses composer selesai, melalui browser Anda masuk ke alamat web dimana file popoji.v.x.x.x-composer.zip tadi diextract.
5. Ikuti petunjuk instalasi dengan benar dan pastikan semua kebutuhan sistem terpenuhi sebelum instalasi.
6. Jika instalasi berhasil, hapuslah atau rename file install.php dan hapus README file ini dari directory web Anda.
7. POPOJI siap untuk digunakan.
8. Semua konfigurasi engine ada pada file po-includes/.env

### Catatan (harap dibaca)

#### Localhost
Jika diinstall pada localhost maka pastikan settingan ``rewrite_module = on``

#### Error 500
Jika terjadi error ``500 internal server error`` (web telah di hosting), kemungkinan karena pada file ``.htaccess`` belum ada baris code ``RewriteBase /``. Solusinya adalah dengan menambahkan baris code ``RewriteBase /`` sebelum code ``RewriteEngine on``

#### Masalah Redirect
Jika terjadi error ``The page isn't redirecting properly`` atau ``This webpage has a redirect loop`` maka langkah yang bisa dilakukan adalah sebagai berikut:
* Coba periksa kembali apakah ``rewrite_module`` sudah on atau belum.
* Periksa apakah file ``.htaccess`` tercopy pada server local atau hosting dengan baik.
* Setelah itu clear cache browser Anda.

#### Kemungkinan File error
Jika terdapat error yang lain, mungkin karena hasil extract file yang tidak sempurna, silahkan replace file-file yang error tersebut.

#### Permission
Untuk di hosting, lakukan perubahan user permission untuk folder-folder berikut menjadi 775 :
* po-content/uploads
* po-content/thumbs
* po-content/backups
* po-content/installer
* po-includes/storage

## Login backend POPOJI
* Masuk ke alamat http://nama.web.anda/login
* Masukkan data login sebagai berikut :
	* Username : seperti yg telah diinputkan pada saat proses instalasi.
	* Password : seperti yg telah diinputkan pada saat proses instalasi.

## API Popoji
http://nama.web.anda/api/v1

# Terima Kasih Kepada
1. Tuhan Yang Maha Esa
2. Orang-orang yang berada di belakang POPOJI
3. Aries sebagai pembuat template backend v.1.0.1 - v.1.1.1
4. Aquincum sebagai pembuat template backend v.1.1.2 - v.1.2.2
5. ProUI sebagai pembuat template backend v.1.2.3 - v.1.3.0
6. Dashforge sebagai pembuat template backend v.3.0.0
7. Enews, Magazine, Andia, Brownie, Wiretree, Neon, Pressroom dan Canvas sebagai pembuat template frontend
8. Laravel sebagai engine core untuk POPOJI v.3.0.0
9. StructureCore Installation sebagai referensi modul instalasi
10. Easy Menu Manager sebagai pembuat component menu manager pada versi < v.2.x.x
11. FluentPDO, Bramus, Plates dan semua library php yang dipakai pada POPOJI pada versi < v.2.x.x
12. Jquery, Bootstrap dan semua plugins jquery yang dipakai pada POPOJI