<?php

namespace Mini\controllers;

class Subpage extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        echo "Subpage";
    }
}
