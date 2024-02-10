<?php
require '../init.php'; // import file init

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // jika form nya dikirim
    $foto = $_FILES['foto']; // ambil data foto
    $posts_id = $_POST['id']; // id post
    $caption = $_POST['caption']; // ambil teks caption

    $sql = '';
    if ($foto['size'] > 0) {
        $file_name = process_upload_file($foto); // proses file, dan ambil nama filenya
        $sql = "UPDATE posts SET gambar = '{$file_name}', caption = '$caption' WHERE id = {$posts_id} AND users_id = {$user['id']}";
    } else {
        $sql = "UPDATE posts SET caption = '$caption' WHERE id = {$posts_id} AND users_id = {$user['id']}";
    }
    // update postingan ke database
    db()->query($sql);
    redirect("index.php#post-{$posts_id}"); // alihkan ke halaman postingan (index.php)
}

// data postingan lama
$post = db()->query("SELECT * FROM posts WHERE id = {$_GET['id']}")->fetch_assoc();
?>

<!-- atur judul halaman dan import header dan navigasi -->
<?php $title = 'Edit Postingan'; require '../layout/header.php' ?>
<?php require '../layout/nav.php' ?>

<!--
    Penjelasan
    action="" kosong karena kita akan mengirim formulir ke halaman yang sama
    enctype="multipart/form-data" harus menambahkan ini jika ingin mengupload file,
        jika tidak maka filenya tidak akan bisa diupload
-->
<form action="" method="post" enctype="multipart/form-data" class="container p-5">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
    <input type="file" name="foto" id="" class="form-control mb-3">
    <textarea name="caption" id="" cols="30" rows="10" class="form-control"><?= $post['caption'] ?></textarea>
    <button type="submit" class="btn btn-primary">Posting</button>
</form>

<!-- import footer -->
<?php require '../layout/footer.php' ?>