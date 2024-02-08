<?php

require '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // jika tombol suka diklik
    $users_id = $_POST['users_id']; // ambil id user yang mengklik tombol
    $posts_id = $_POST['posts_id']; // ambil id postingan yang disukai

    // cek apakah user dengan id ini telah menyukai postingan ini sebelumnya
    $sql = "SELECT COUNT(id) as count FROM likes WHERE users_id = {$users_id} AND posts_id = {$posts_id}";
    $like = db()->query($sql)->fetch_assoc();

    if ($like['count'] == 0) { // jika tidak pernah, maka simpan datanya
        $sql = "INSERT INTO likes (users_id, posts_id) VALUE ({$users_id}, {$posts_id})";
        db()->query($sql);
    }

    // kembali ke halaman postingan dengan hash property(#post-{$post-id})
    // agar kembali ke bagian postingan yang disukai
    redirect("index.php#post-{$posts_id}");
}
