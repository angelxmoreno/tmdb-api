<?php
declare(strict_types=1);

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
        $keywords = $this->Movies->Keywords->find('list', ['limit' => 200, 'order' => 'name']);
        $genres = $this->Movies->Genres->find('list', ['limit' => 200, 'order' => 'name']);
        $companies = $this->Movies->ProductionCompanies->find('list', ['limit' => 200, 'order' => 'name']);

        $this->set(compact('movies', 'keywords', 'genres', 'companies'));
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
            'contain' => ['Genres', 'Keywords', 'ProductionCompanies', 'Videos', 'Casts' => ['People'], 'Crews' => ['People'], 'Reviews' => ['Reviewers'], 'MoviePosters', 'MovieBackdrops'],
        ]);

        $this->set('movie', $movie);
    }
}
