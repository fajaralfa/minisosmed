<?php

require '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $posts_id = $_POST['posts_id'];

    db()->begin_transaction();

    $sql = "DELETE FROM likes WHERE posts_id = {$posts_id}";
    db()->query($sql);

    $sql = "SELECT gambar FROM posts WHERE id = {$posts_id} AND users_id = {$user['id']}";
    $gambar = db()->query($sql)->fetch_assoc()['gambar'];
    unlink("../upload/{$gambar}");

    $sql = "DELETE FROM posts WHERE id = {$posts_id} AND users_id = {$user['id']}";
    db()->query($sql);
    db()->commit();

    redirect('index.php');
}
