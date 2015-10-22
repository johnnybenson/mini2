<?php

namespace Mini\controllers;

// GET request on /songs/deletesong/:song_id, where :song_id is a mandatory song id.
// Performs an action on the model and redirects the user to /songs.

class SongsUpdate extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        $model = new \Mini\models\Songs($this->app->config('database'));

        // TODO: Add a request object
        // TODO: passing an array would be better here, but for simplicity this way it okay
        $model->updateSong($_POST['song_id'], $_POST["artist"], $_POST["track"], $_POST["link"], $_POST["year"], $_POST["country"], $_POST["genre"]);

        $this->app->redirect('/songs');
    }
}

