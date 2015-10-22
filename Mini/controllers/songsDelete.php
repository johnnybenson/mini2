<?php

namespace Mini\controllers;

// GET request on /songs/deletesong/:song_id, where :song_id is a mandatory song id.
// Performs an action on the model and redirects the user to /songs.

class SongsDelete extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        $model = new \Mini\models\Songs($this->app->config('database'));
        $model->deleteSong($song_id);

        $this->app->redirect('/songs');
    }
}

