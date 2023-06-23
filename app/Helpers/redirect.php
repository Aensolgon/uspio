<?php

function redirect($url, $permanent = false): void
{
    header('Content-Type: text/html; charset=utf-8');
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
