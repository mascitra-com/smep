<?php
if ( ! function_exists('monefy'))
{
    function monefy($text="", $is_decimal = TRUE)
    {
        if ($is_decimal) {
            return number_format($text,0,',','.');
        }
        return number_format($text);
    }
}