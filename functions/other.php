<?php

function redirect($target)
{
    header("location: {$target}");
    die;
}
