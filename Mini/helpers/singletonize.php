<?php

namespace Mini\helpers;

trait Singletonize
{
    protected static $instance;

    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self(func_get_arg(0));
        }
        return self::$instance;
    }
}
