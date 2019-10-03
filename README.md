# Popoji
Free Engine Management System - Indonesia
Contact : info@popojicms.org

## Cara Instalasi Popoji

1. Extract file popoji.v.x.x.x.zip di directory web Anda.
2. Buatlah database baru yang nantinya sebagai tempat instalasi tabel-tabel.
3. Melalui browser Anda, masuk ke alamat web dimana file popoji.v.x.x.x.zip tadi diextract.
4. Ikuti petunjuk instalasi dengan benar.
5. Jika instalasi berhasil, hapuslah atau rename file install.php dan hapus README file ini dari directory web Anda.
6. Popoji siap untuk digunakan.

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
Untuk di hosting, lakukan perubahan user permission untuk folder po-upload menjadi 775 (po-content --> uploads).

## Login backend Popoji
* Masuk ke alamat http://nama.web.anda/login
* Masukkan data login sebagai berikut :
** Username : seperti yg telah diinputkan pada saat proses instalasi.
** Password : seperti yg telah diinputkan pada saat proses instalasi.


# Terima Kasih Kepada
1. Tuhan Yang Maha Esa
2. Orang-orang yang berada di belakang Popoji
3. Aries sebagai pembuat template backend v.1.0.1 - v.1.1.1
4. Aquincum sebagai pembuat template backend v.1.1.2 - v.1.2.2
5. ProUI sebagai pembuat template backend v.1.2.3 - v.1.3.0
6. Dashforge sebagai pembuat template backend v.3.0.0
7. Enews, Magazine, Andia, Brownie, Wiretree, Neon, Pressroom dan Canvas sebagai pembuat template frontend
8. Laravel sebagai engine core untuk Popoji v.3.0.0
9. StructureCore Installation sebagai referensi modul instalasi
10. Easy Menu Manager sebagai pembuat component menu manager
11. FluentPDO, Bramus, Plates dan semua library php yang dipakai pada Popoji
12. Jquery, Bootstrap dan semua plugins jquery yang dipakai pada Popoji