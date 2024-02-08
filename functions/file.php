<?php

/**
 *  format / ekstensi adalah istilah yang digunakan untuk menyebutkan akhiran dari nama file
 *  yang menunjukkan jenis atau format file tersebut
 */

// membuat nama file acak dengan ekstensi sesuai nama input file
function random_file_name($file_name)
{
    $parsed_file_name = explode('.', $file_name); // ubah file menjadi array
    $extensions = end($parsed_file_name); // ambil teks terakhir (yaitu ekstensinya)
    $random_bytes_hex = bin2hex(random_bytes(16)); // buat teks acak
    $random_file_name = "{$random_bytes_hex}.{$extensions}"; // satukan teks acak dengan ekstensi yang diambil
    return $random_file_name; // kembalikan hasilnya
}

/** 
 * memindahkan file ke folder tertentu dengan nama acak
 * kenapa namanya acak?
 * - karena ada kemungkinan setiap user mengupload file dengan nama yang sama
 * bagaimana cara kita tahu apa nama filenya jika namanya acak?
 * - nama file acaknya akan kita simpan di database nanti,
 * - jadi kita tinggal ambil nama filenya di database, lalu kita proses.
 */
function process_upload_file($file)
{
    // file upload disimpan di sebuah folder sementara di server jadi nantinya file ini akan dihapus
    // setelah beberapa saat (waktunya ditentukan oleh konfigurasi server)
    $tmp_name = $file['tmp_name']; // ambil nama tempat file sementara disimpan di server
    $file_name = $file['name']; // ambil nama file yang diupload oleh user

    $upload_dir = __DIR__ . '/../upload'; // buat folder untuk menyimpan file hasil upload
    $new_file_name = random_file_name($file_name); // buat nama file acak
    $target = "{$upload_dir}/$new_file_name"; // satukan nama folder dengan nama file acak

    if (!is_dir($upload_dir)) { // jika foldernya belum ada
        mkdir($upload_dir); // maka buat foldernya
    }

    // pindahkan file di folder sementara ke folder target
    move_uploaded_file($tmp_name, $target);

    return $new_file_name; // kembalikan nama file baru untuk disimpan di database
}
