<?php
declare(strict_types=1);

namespace App\Controller\Api;

/**
 * Movies Controller
 *
 * @property \App\Model\Table\MoviesTable $Movies
 * @property \App\Model\Table\PeopleTable $People
 *
 * @method \App\Model\Entity\Movie[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MoviesController extends RestController
{
    protected $containedRelationships = ['Genres', 'Keywords', 'ProductionCompanies', 'Videos', 'Casts' => ['People'], 'Crews' => ['People'], 'Reviews' => ['Reviewers'], 'MoviePosters', 'MovieBackdrops'];

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('People');
    }

    /**
     * @param int $person_id
     */
    public function person(int $person_id)
    {
        $this->request->allowMethod(['get']);
        $person = $this->People->get($person_id);
        $asCastMovies = $this->Movies->find()
            ->matching('Casts', function ($q) use ($person) {
                return $q->where(['Casts.person_id' => $person->id]);
            })
            ->all();

        $asCrewMovies = $this->Movies->find()
            ->matching('Crews', function ($q) use ($person) {
                return $q->where(['Crews.person_id' => $person->id]);
            })
            ->all();
        $movies = \collection(array_merge($asCastMovies->toArray(), $asCrewMovies->toArray()))->indexBy('id')->toList();
        $this->successResponse($movies);
    }
}
