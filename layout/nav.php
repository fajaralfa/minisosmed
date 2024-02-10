<nav class="navbar navbar-expand bg-primary navbar-dark m-auto" style="position: sticky; top: 0; z-index: 1; max-width: 35em;">
    <div class="container-fluid justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="<?= uri_for('/postingan/index.php') ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="<?= uri_for('/postingan/buat.php') ?>" class="nav-link">Buat</a>
            </li>
            <li class="nav-item">
                <a href="<?= uri_for('/profil/') ?>" class="nav-link">Profil</a>
            </li>
            <li class="nav-item">
                <form action="<?= uri_for('/logout.php') ?>" method="post">
                    <button type="submit" class="nav-link" onclick="return confirm('Logout?')">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>