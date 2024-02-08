<?php

require '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users_id = $_POST['users_id'];
    $posts_id = $_POST['posts_id'];

    $sql = "SELECT COUNT(id) as count FROM likes WHERE users_id = {$users_id} AND posts_id = {$posts_id}";
    $like = db()->query($sql)->fetch_assoc();
    if ($like['count'] == 0) {
        $sql = "INSERT INTO likes (users_id, posts_id) VALUE ({$users_id}, {$posts_id})";
        db()->query($sql);
    }

    redirect("index.php#post-{$posts_id}");
}
