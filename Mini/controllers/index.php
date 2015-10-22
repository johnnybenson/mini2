<?php

namespace Mini\controllers;

class Index extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        echo "Index";
    }
}
