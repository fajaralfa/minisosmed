<?php

/**
 * import file init.php
 * file ini berisi operasi yang umum digunakan dalam setiap halaman
 * seperti:
 * - memulai session
 * - mengimport file lain yang berisi function yang berfungsi untuk menyambungkan database, dll
 * - dll
 */
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

$title = 'Login'; // judul halaman
require 'layout/header.php' // import file header (bagian atas halaman yang berisi metadata, judul, css, js, dll)
?>

<!-- form login -->
<div class="container py-5">
    <h1 class="text-center mb-5 h2">Login | Aplikasi</h1>
    <form action="" method="post" style="max-width: 25em;" class="d-flex flex-column gap-4 mx-auto">
        <!-- menampilkan pesan - pesan error jika ada -->
        <?php foreach (session_get('errors') as $error) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endforeach ?>
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