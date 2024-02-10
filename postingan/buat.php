<?php
require '../init.php'; // import file init

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // jika form nya dikirim
    $foto = $_FILES['foto']; // ambil data foto
    $caption = $_POST['caption']; // ambil teks caption

    $file_name = process_upload_file($foto); // proses file, dan ambil nama filenya

    // simpan postingan ke database
    db()->query("INSERT INTO posts (users_id, gambar, caption) VALUES ({$user['id']}, '{$file_name}', '{$caption}')");

    redirect('index.php'); // alihkan ke halaman postingan (index.php)
}
?>

<!-- atur judul halaman dan import header dan navigasi -->
<?php $title = 'Buat Postingan'; require '../layout/header.php' ?>
<?php require '../layout/nav.php' ?>

<!--
    Penjelasan
    action="" kosong karena kita akan mengirim formulir ke halaman yang sama
    enctype="multipart/form-data" harus menambahkan ini jika ingin mengupload file,
        jika tidak maka filenya tidak akan bisa diupload
-->
<form action="" method="post" enctype="multipart/form-data" class="container p-5">
    <input type="file" name="foto" id="" class="form-control"><br>
    <textarea name="caption" id="" cols="30" rows="10" class="form-control"></textarea><br>
    <button type="submit" class="btn btn-primary">Posting</button>
</form>

<!-- import footer -->
<?php require '../layout/footer.php' ?>