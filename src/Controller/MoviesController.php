<?php

namespace App\Controller;

/**
 * Movies Controller
 *
 * @property \App\Model\Table\MoviesTable $Movies
 *
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MoviesController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $movies = $this->paginate($this->Movies);

        $this->set(compact('movies'));
    }

    /**
     * View method
     *
     * @param string|null $id Movie id.
     * @return void
     */
    public function view($id = null)
    {
        $movie = $this->Movies->get($id, [
            'contain' => ['Genres', 'Keywords', 'ProductionCompanies', 'Videos', 'Casts' => ['People'], 'Crews' => ['People'], 'Reviews'=>['Reviewers'], 'MoviePosters', 'MovieBackdrops'],
        ]);

        $this->set('movie', $movie);
    }
}
