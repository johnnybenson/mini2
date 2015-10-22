<?php

namespace Mini\controllers;

// GET request on /songs/deletesong/:song_id, where :song_id is a mandatory song id.
// Performs an action on the model and redirects the user to /songs.

class SongsSearch extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        $model = new \Mini\models\Songs($this->app->config('database'));

        $result_songs = $model->searchSong($_POST['search_term']);

        $this->template_data = array(
            'amount_of_results' => count($result_songs),
            'songs' => $result_songs
        );

        // TODO: if $_GET
        // $this->app->redirect('/songs');
    }
}
