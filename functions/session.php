<?php

/**
 * atur nilai session
 */
function session_set($key, $value)
{
    $_SESSION[$key] = $value;
}

/**
 * atur nilai session yang hanya akan ada sekali
 */
function session_flash($key, $value)
{
    // semua data di session dengan key _flash akan dihapus setelah ditampilkan sekali
    // kenapa pakai underscore? untuk menghindari konflik dengan data session lainnya
    // cara ini umum digunakan di framework - framework php
    $_SESSION['_flash'][$key] = $value;
}

/**
 * ambil data session
 */
function session_get($key, $default = [])
{
    // ambil data session flash,
    // jika tidak ada maka ambil data session biasa,
    // jika tidak ada juga maka ambil data bawaannya yaitu array kosong
    return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
}

/**
 * mengosongkan data session dengan $key
 */
function session_remove($key)
{
    $_SESSION[$key] = [];
}
