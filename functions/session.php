<?php

function session_set($key, $value)
{
    $_SESSION[$key] = $value;
}

function session_flash($key, $value)
{
    $_SESSION['_flash'][$key] = $value;
}

function session_get($key, $default = [])
{
    return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
}

function session_remove($key)
{
    $_SESSION[$key] = [];
}
