<?php

// File ini berfungsi untuk mengkonfigurasi dan mengimport file - file lain
// yang sering digunakan seperti memulai session, koneksi database, dan lain - lain.
// file ini harus diimport di bagian paling atas

// sebelum menggunakan session, kita harus memulai session dengan function session_start
session_start();

// atur zona waktu menjadi asia/jakarta, atau sesuaikan dengan daerah kalian
date_default_timezone_set('Asia/Jakarta');

// import file yang berisi fungsi - fungsi untuk:
require __DIR__ . '/functions/db.php'; // koneksi ke database
require __DIR__ . '/functions/file.php'; // mengatur file 
require __DIR__ . '/functions/other.php'; // fungsi lain yang tidak tahu kategorinya
require __DIR__ . '/functions/session.php'; // mengatur data session

$user = session_get('user'); // ambil data user dari session agar variabelnya bisa digunakan langsung
