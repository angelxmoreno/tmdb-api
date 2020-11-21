<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Cake\ORM\Table;

/**
 * Class RestController
 * @package App\Controller\Api
 */
class RestController extends ApiAppController
{
    protected $containedRelationships = [];

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

        $this->successResponse($this->ApiPaginator->paginate($this->getControllerModel()));
    }

    /**
     * @return bool|Table|object
     */
    protected function getControllerModel()
    {
        return $this->{$this->getName()};
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
        $entity = $this->getControllerModel()->get($id, [
            'contain' => $this->containedRelationships
        ]);

        $this->successResponse($entity);
    }
}
