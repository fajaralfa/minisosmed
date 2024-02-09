<?php

/**
 * berfungsi untuk mengalihkan halaman ke $target
 */
function redirect($target)
{
    header("location: {$target}"); // set location menjadi target
    die; // berfungsi untuk berhenti menjalankan apapun setelah mengalihkan halaman
}

/**
 * mengecek apakah string $haystack berisikan string dari array $needle
 */
function str_has(string $haystack, array $needles)
{
    $flag = true;
    foreach ($needles as $t) {
        if (str_contains($haystack, $t)) {
            continue;
        } else {
            $flag = false;
            break;
        }
    }

    return $flag;
}