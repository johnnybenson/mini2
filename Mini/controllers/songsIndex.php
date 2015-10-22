<?php

namespace Mini\controllers;

// GET request on /songs. Perform actions getAmountOfSongs() and getAllSongs() and pass the result to the view.
// Note that $model is passed to the route via "use ($app, $model)". I've written it like that to prevent creating
// the model / database connection in routes that does not need the model / db connection.

class SongsIndex extends _base
{
    use \Mini\helpers\Singletonize;

    public function view()
    {
        $model = new \Mini\models\Songs($this->app->config('database'));

        $amount_of_songs = $model->getAmountOfSongs();
        $songs = $model->getAllSongs();

        $this->template_data = array(
            'amount_of_songs' => $amount_of_songs,
            'songs' => $songs
        );
    }
}

