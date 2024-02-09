<?php

require 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // jika form dikirim
    // ambil data name, username dan password dari form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // cari data user di database berdasarkan username dan password dari form
    $sql = "INSERT INTO users (name, username, password) VALUES
        ('$name','$username','$password')";

    try {
        db()->query($sql);
        redirect('login.php');
    } catch (mysqli_sql_exception $e) {
        $err_duplicate_username = str_has($e->getMessage(), ['Duplicate entry', 'username']);

        if ($err_duplicate_username) {
            session_flash('errors', ['Username telah digunakan']);
            redirect('');
        } else {
            throw $e;
        }
    }
}
?>


<?php
$title = 'Register'; // judul halaman
require 'layout/header.php' // import file header (bagian atas halaman yang berisi metadata, judul, css, js, dll)
?>

<!-- form register -->
<div class="container py-5">
    <h1 class="text-center mb-5 h2">Register | Aplikasi</h1>
    <form action="" method="post" style="max-width: 25em;" class="d-flex flex-column gap-4 mx-auto">
        <!-- menampilkan pesan - pesan error jika ada -->
        <?php foreach (session_get('errors') as $error) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endforeach ?>
        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" id="" placeholder="John Doe" class="form-control">
        </div>
        <div>
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="" placeholder="Username" class="form-control">
        </div>
        <div>
            <label for="password" class="formm-label">Password</label>
            <input type="password" name="password" id="" placeholder="******" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>

<!-- import footer -->
<?php require 'layout/footer.php' ?>