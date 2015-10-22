<?php

namespace Mini\controllers;

// GET request on /songs/deletesong/:song_id, where :song_id is a mandatory song id.
// Performs an action on the model and redirects the user to /songs.

class SongsEdit extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        $song_id = $this->request_params['song_id'];
        $model = new \Mini\models\Songs($this->app->config('database'));
        $song = $model->getSong($song_id);

        $this->template_data['song'] = $song;

        if (!$song) {
            $this->app->redirect('/songs');
        }
    }
}

