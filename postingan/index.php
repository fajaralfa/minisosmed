<?php require '../init.php' ?>

<?php
$page_section = (int) ($_GET['page'] ?? 0);
$page_offset = $page_section * 10;
$sql = "SELECT
    users.name, users.username, posts.id, posts.users_id, posts.gambar, posts.caption, posts.waktu, COUNT(likes.id) AS likes
    FROM posts LEFT JOIN likes ON posts.id = likes.posts_id LEFT JOIN users ON posts.users_id = users.id
    GROUP BY posts.id ORDER BY posts.waktu DESC LIMIT 10 OFFSET {$page_offset}";
$posts = db()->query($sql)->fetch_all(MYSQLI_ASSOC);
$posts_count = count($posts);
?>

<!-- Halaman -->
<?php require '../layout/header.php' ?>
<?php require '../layout/nav.php' ?>

<div class="border rounded-2 m-auto" style="width: 35em; min-height: 30em;">
    <?php foreach ($posts as $post) : ?>
        <div class="card card-primary" id="post-<?= $post['id'] ?>">
            <div class="card-header bg-white p-1 d-flex justify-content-between align-items-center" style="font-size: 0.8em;">
                <div>
                    <div><?= $post['name'] ?></div>
                    <div><?= $post['username'] ?></div>
                </div>
                <div>
                    <?= $post['waktu'] ?>
                </div>
            </div>
            <div><img src="../upload/<?= $post['gambar'] ?>" alt="" srcset="" width="100%"></div>
            <div class="border px-3">
                <div class="mt-2 d-flex justify-content-between" style="font-size: small;">
                    <div>
                        <form action="like.php" method="post">
                            <input type="hidden" name="users_id" value="<?= session_get('user')['id'] ?>">
                            <input type="hidden" name="posts_id" value="<?= $post['id'] ?>">
                            <button type="submit">Like</button>
                        </form>
                        <div class="text-center"><?= $post['likes'] ?></div>
                    </div>
                    <div>
                        <?php if ($post['users_id'] == $user['id']) : ?>
                            <form action="hapus.php" method="post">
                                <input type="hidden" name="posts_id" value="<?= $post['id'] ?>">
                                <button type="submit" onclick="return confirm('Hapus postingan ini?')">Hapus</button>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="card-body p-2" style="min-height: 4em;">
                <?= $post['caption'] ?>
            </div>
        </div>
    <?php endforeach ?>
    <div class="d-flex p-4">
        <?php if ($page_section > 0) : ?>
            <a href="index.php?page=<?= $page_section - 1 ?>" style="margin-right: auto;">Sebelumnya</a>
        <?php endif ?>
        <?php if ($posts_count == 10) : ?>
            <a href="index.php?page=<?= $page_section + 1 ?>" style="margin-left: auto;">Selanjutnya</a>
        <?php endif ?>
    </div>
</div>

<?php require '../layout/footer.php' ?>