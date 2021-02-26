<?php

function isCheckObjectValue($a, $array)
{
    foreach ($array as $value) {
        if (!$value){
            return false;
        }
    }
    return true;
}

var_dump(isCheckObjectValue(['test'], array(
    'a' => 'a',
    'b' => 'a',
    'c' => 'a',
    'd' => 'a',
)));
