Penjelasan kode
1. Koneksi ke Database (PHP) = membuat koneksi ke database menggunakan PHP Data Object (PDO)
2. Pada bagian <head> terdapat Bootstrap CSS dan DataTables CC untuk tampilan
3. Tabel Data Karyawan = Tabel ini menampilkan data karyawan, seperti ID, Nama, Jabatan, dan Gaji
4. Modal Tambah Karyawan = form untuk menambahkan data karyawan baru
5. JQueary dan DataTables = menginisiasi DataTables dan memuat data via AJAX dari file get_employees.php serta menambahkan tombol edit dan hapus untuk setiap baris data
6. Form Tambah Data = saat form di submit, data akan dikirim ke file add_employee.php menggunakan AJAX
7. Hapus Data = saat tombol Hapus diklik, data akan dikirim ke file delete_employee.php kemudian data tabel akan diperbarui
