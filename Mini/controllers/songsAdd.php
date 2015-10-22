<?php

namespace Mini\controllers;

// GET request on /songs/deletesong/:song_id, where :song_id is a mandatory song id.
// Performs an action on the model and redirects the user to /songs.

class SongsAdd extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        $model = new \Mini\models\Songs($this->app->config('database'));

        // TODO: Add a request object
        // TODO: in a real-world app it would be useful to validate the values (inside the model)
        $model->addSong($_POST["artist"], $_POST["track"], $_POST["link"], $_POST["year"], $_POST["country"], $_POST["genre"]);

        $this->app->redirect('/songs');
    }
}
