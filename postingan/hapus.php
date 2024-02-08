<?php

require '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // jika form untuk hapus dikirim
    $posts_id = $_POST['posts_id']; // ambil id postingan

    // database transaction berfungsi agar jika salah satu query didalam transaksi gagal,
    // maka dia akan menggagalkan semuanya
    db()->begin_transaction(); // mulai database transaction

    // hapus semua likes dari postingan dengan id ini
    $sql = "DELETE FROM likes WHERE posts_id = {$posts_id}";
    db()->query($sql);

    // ambil foto postingan
    $sql = "SELECT gambar FROM posts WHERE id = {$posts_id} AND users_id = {$user['id']}";
    $gambar = db()->query($sql)->fetch_assoc()['gambar'];
    // hapus foto postingan
    unlink("../upload/{$gambar}");

    // terakhir, hapus postingan
    $sql = "DELETE FROM posts WHERE id = {$posts_id} AND users_id = {$user['id']}";
    db()->query($sql);

    db()->commit(); // simpan perubahan pada database

    redirect('index.php'); // kembali ke halaman postingan
}
