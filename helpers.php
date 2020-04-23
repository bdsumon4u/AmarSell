<?php

function theMoney($amount, $currency = "৳")
{
    return "$currency " . number_format($amount,null,null,',');
}