<?php

function theMoney($amount, $currency = "৳")
{
    return "$currency " . number_format($amount,null,null,',');
}

function bytesToHuman($bytes)
{
    $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
}