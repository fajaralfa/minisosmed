<?php

function random_file_name($file_name)
{
    $parsed_file_name = explode('.', $file_name);
    $extensions = end($parsed_file_name);
    $random_bytes_hex = bin2hex(random_bytes(16));
    $random_file_name = "{$random_bytes_hex}.{$extensions}";
    return $random_file_name;
}

function process_upload_file($file)
{
    $tmp_name = $file['tmp_name'];
    $file_name = $file['name'];

    $upload_dir = __DIR__ . '/../upload';
    $new_file_name = random_file_name($file_name);
    $target = "{$upload_dir}/$new_file_name";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir);
    }

    move_uploaded_file($tmp_name, $target);

    return $new_file_name;
}
