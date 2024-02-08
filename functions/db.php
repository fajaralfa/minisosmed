<?php

$db = null; // buat variabel global $db dengan nilai null (kosong)
function db()
{
    global $db; // gunakan variabel global $db (jika tidak menggunakan ini, maka variabel global tidak bisa diakses)
    if ($db == null) { // jika variable globalnya masih null
        $db = mysqli_connect('localhost', 'root', '', 'galeri_fajar_xiirpl2'); // buat koneksi baru
    }
    return $db; // kembalikan koneksi $db
}
