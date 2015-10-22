<?php

namespace Mini\helpers;

trait String
{
    public static function camel2whatever($str, $separator = "-")
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1' . $separator, $str));
    }
}
