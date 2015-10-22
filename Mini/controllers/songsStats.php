<?php

namespace Mini\controllers;

// GET request on /songs/ajaxGetStats. In this demo application this route is used to request data via
// JavaScript (AJAX). Note that this does not render a view, it simply echoes out JSON.

class SongsStats extends _base
{
    use \Mini\helpers\Singletonize;

    public $format = 'JSON';

    public function view()
    {
        $model = new \Mini\models\Songs($this->app->config('database'));

        $this->app->contentType('application/json;charset=utf-8');
        $this->template_data = $model->getAmountOfSongs();
    }
}

