<?php
declare(strict_types=1);

namespace App\Controller\Api;

/**
 * Movies Controller
 *
 * @property \App\Model\Table\MoviesTable $Movies
 *
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MoviesController extends ApiAppController
{
    protected $containedRelationships = ['Genres', 'Keywords', 'ProductionCompanies', 'Videos', 'Casts' => ['People'], 'Crews' => ['People'], 'Reviews' => ['Reviewers'], 'MoviePosters', 'MovieBackdrops'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->request->allowMethod(['get']);
        $this->paginate = [
            'contain' => [],
        ];

        $this->successResponse($this->ApiPaginator->paginate($this->Movies));
    }

    /**
     * View method
     *
     * @param string|null $id Movie id.
     * @return void
     */
    public function view($id = null)
    {
        $this->request->allowMethod(['get']);
        $movie = $this->Movies->get($id, [
            'contain' => $this->containedRelationships
        ]);

        $this->successResponse($movie);
    }
}
