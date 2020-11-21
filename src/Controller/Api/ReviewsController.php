<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\Http\Exception\NotFoundException;

/**
 * Reviews Controller
 */
class ReviewsController extends RestController
{
    protected $containedRelationships = ['Reviewers'];
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
       throw new NotFoundException();
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
        $this->paginate = [
            'contain' => $this->containedRelationships,
            'conditions' => [
                'movie_id' => $id
            ]
        ];

        $this->successResponse($this->ApiPaginator->paginate($this->getControllerModel()));
    }
}
