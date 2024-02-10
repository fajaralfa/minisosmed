<?php
require '../init.php'; // import file init

$page_section = (int) ($_GET['page'] ?? 0); // ambil nomor halaman, jika tidak ada maka ambil 0
$page_offset = $page_section * 10; // offset query sql (bagian awal data yang diambil)

// query sql
// singkatnya: ambil data yang membuat postingan, data postingannya, dan jumlah likenya.
$sql = "SELECT
    users.name, users.username, posts.id, posts.users_id, posts.gambar, posts.caption, posts.waktu, COUNT(likes.id) AS likes
    FROM posts LEFT JOIN likes ON posts.id = likes.posts_id LEFT JOIN users ON posts.users_id = users.id
    GROUP BY posts.id ORDER BY posts.waktu DESC LIMIT 10 OFFSET {$page_offset}";

/**
 * eksekusi query sql,
 * MYSQLI_ASSOC berfungsi agar data yang diambil berbentuk associative array
 * yang keynya adalah nama kolom tabel
 */
$posts = db()->query($sql)->fetch_all(MYSQLI_ASSOC);
$posts_count = count($posts); // ambil data jumlah postingan yang diambil
?>

<!-- header dan navigasi -->
<?php $title = 'Postingan';
require '../layout/header.php' ?>
<?php require '../layout/nav.php' ?>

<!-- bagian untuk postingan -->
<div class="container rounded-2 mx-auto bg-white" style="max-width: 35em;">
    <!-- tampilkan setiap postingan -->
    <?php foreach ($posts as $post) : ?>
        <div class="card border-0 border-top border-bottom" id="post-<?= $post['id'] ?>">
            <div class="card-header bg-white p-1 d-flex justify-content-between align-items-center" style="font-size: 0.8em;">
                <div>
                    <!-- data pembuat postingan -->
                    <div><?= $post['name'] ?></div>
                    <div><?= $post['username'] ?></div>
                </div>
                <div>
                    <!-- waktu posting -->
                    <?= date("H:i d M Y", strtotime($post['waktu'])) ?>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- gambar yang diposting -->
                <img src="../upload/<?= $post['gambar'] ?>" alt="" srcset="" width="100%" class="rounded-1 shadow-lg">
                <div class="d-flex align-items-start py-2" style="font-size: small; gap: 1em;">
                    <!-- formulir untuk menyukai postingan -->
                    <form action="like.php" method="post">
                        <input type="hidden" name="users_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="posts_id" value="<?= $post['id'] ?>">
                        <button type="submit" class="btn p-0">
                            <img src="../assets/icon/like.svg" alt="like button" style="height: 20px;">
                        </button>
                        <!-- tampilkan jumlah postingan -->
                        <div class="text-center"><?= $post['likes'] ?></div>
                    </form>
                    <!-- tampilkan opsi edit dan hapus jika user yang login adalah yang membuat postingan -->
                    <?php if ($post['users_id'] == $user['id']) : ?>
                        <a href="edit.php?id=<?= $post['id'] ?>" class="btn p-0"><img src="../assets/icon/edit.svg" alt="" style="height: 20px;"></a>
                        <form action="hapus.php" method="post">
                            <input type="hidden" name="posts_id" value="<?= $post['id'] ?>">
                            <button type="submit" onclick="return confirm('Hapus postingan ini?')" class="btn p-0">
                                <img src="../assets/icon/delete.svg" alt="delete button" style="height: 20px;">
                            </button>
                        </form>
                    <?php endif ?>
                </div>
            </div>
            <div class="px-3 pb-5">
                <!-- teks captionnyaa -->
                <?= $post['caption'] ?>
            </div>
        </div>
    <?php endforeach ?>
    <div class="d-flex p-4">
        <!-- jika halamannya bukan yang pertama (0) maka tampilkan tombol kembali -->
        <?php if ($page_section > 0) : ?>
            <a href="index.php?page=<?= $page_section - 1 ?>" style="margin-right: auto;">Sebelumnya</a>
        <?php endif ?>
        <!-- jika postingan yang ada adalah 10 maka tampilkan tombol selanjutnya -->
        <?php if ($posts_count == 10) : ?>
            <a href="index.php?page=<?= $page_section + 1 ?>" style="margin-left: auto;">Selanjutnya</a>
        <?php endif ?>
    </div>
</div>

<!-- footer -->
<?php require '../layout/footer.php' ?>