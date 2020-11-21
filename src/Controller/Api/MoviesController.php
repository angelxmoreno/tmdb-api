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
class MoviesController extends RestController
{
    protected $containedRelationships = ['Genres', 'Keywords', 'ProductionCompanies', 'Videos', 'Casts' => ['People'], 'Crews' => ['People'], 'Reviews' => ['Reviewers'], 'MoviePosters', 'MovieBackdrops'];

}
