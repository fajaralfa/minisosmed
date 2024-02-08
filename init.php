<?php

session_start();

date_default_timezone_set('Asia/Jakarta');

require __DIR__ . '/functions/db.php';
require __DIR__ . '/functions/file.php';
require __DIR__ . '/functions/other.php';
require __DIR__ . '/functions/session.php';

$user = session_get('user');
