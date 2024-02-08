<?php
require 'init.php';

// semua yang berawalan '$' (dolar) adalah variabel

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // jika form dikirim
    // ambil data username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // cari data user di database berdasarkan username dan password dari form
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $user = db()->query($sql)->fetch_assoc();

    if (is_null($user)) { // jika data user tidak ditemukan
        // buat pesan kesalahan
        session_flash('errors', ['Username atau password salah']);
        // kembali ke halaman ini (login.php)
        redirect('login.php');
    } else { // jika data user ditemukan
        unset($user['password']); // hilangkan password dari data user
        session_set('user', $user); // set data user di session
        session_flash('pesan', ['Login Berhasil']); // buat pesan flash login berhasil
        redirect('postingan/'); // pindah ke halaman postingan
    }
}
?>

<?php

$title = 'Login'; // judul halaman = Login
require 'layout/header.php' // tambahkan header (bagian atas halaman, yang berisi judul)
?>

<?php foreach (session_get('errors') as $error) : ?>
    <div><?= $error ?></div>
<?php endforeach ?>
<form action="" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id=""><br>
    <label for="password">Password</label>
    <input type="password" name="password" id=""><br>
    <button type="submit">Login</button>
</form>

<?php require 'layout/footer.php' ?>