<?php
require '../init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $foto = $_FILES['foto'];
    $caption = $_POST['caption'];

    $file_name = process_upload_file($foto);

    db()->query("INSERT INTO posts (users_id, gambar, caption) VALUES ({$user['id']}, '{$file_name}', '{$caption}')");

    redirect('index.php');
}
?>

<?php require '../layout/header.php' ?>
<?php require '../layout/nav.php' ?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="foto" id=""><br>
    <textarea name="caption" id="" cols="30" rows="10"></textarea><br>
    <button type="submit">Posting</button>
</form>

<?php require '../layout/footer.php' ?>