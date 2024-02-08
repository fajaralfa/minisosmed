<?php

$db = null;
function db()
{
    global $db;
    if ($db == null) {
        $db = mysqli_connect('localhost', 'root', '', 'galeri_fajar_xiirpl2');
    }
    return $db;
}
