<?php

namespace Mini\helpers;

trait Options
{
    public static function get($arr, $key, $default)
    {
        if (array_key_exists($key, $arr)) {
            return $arr[$key];
        }
        return $default;
    }
}
