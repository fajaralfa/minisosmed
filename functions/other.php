<?php

/**
 * berfungsi untuk mengalihkan halaman ke $target
 */
function redirect($target)
{
    header("location: {$target}"); // set location menjadi target
    die; // berfungsi untuk berhenti menjalankan apapun setelah mengalihkan halaman
}
