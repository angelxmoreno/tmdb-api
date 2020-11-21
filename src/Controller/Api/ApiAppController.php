<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Component\ApiPaginatorComponent;
use Cake\Utility\Hash;

/**
 * Class ApiAppController
 * @package App\Controller\Api
 *
 * @property ApiPaginatorComponent $ApiPaginator
 */
class ApiAppController extends \App\Controller\AppController
{
    public function initialize()
    {
        $this->viewBuilder()->setClassName('Json');
        $this->request = $this->getRequest()->withAddedHeader('Accept', 'application/json');
        parent::initialize();
        $this->loadComponent('ApiPaginator');
    }

    protected function loadAuth()
    {
        parent::loadAuth();
        $this->Auth->setConfig([
            'authenticate' => [
                'ApiKey',
                'Jwt' => [
                    'fields' => [
                        'username' => 'id',
                    ],
                ],
            ],
            'storage' => 'Memory',
            'unauthorizedRedirect' => false,
        ]);
        $this->Auth->deny();
    }

    /**
     * @param mixed $data
     * @param int $status
     */
    protected function successResponse($data, int $status = 200)
    {
        $this->messageResponse($data, true, $status);
    }

    /**
     * @param array|null|\JsonSerializable $data
     * @param bool $success
     * @param int $status
     * @param string|null $errorMsg
     * @param array|null $errors
     */
    protected function messageResponse($data, bool $success, int $status, string $errorMsg = null, array $errors = null)
    {
        $payload = [
            'success' => $success,
            'status' => $status,
        ];

        if ($data) {
            if (is_array($data)) unset($data['_matchingData']);
            $payload['response'] = $data;
        }

        if ($errorMsg) {
            $payload['errorMsg'] = $errorMsg;
        }

        if ($errors) {
            $payload['errors'] = $errors;
        }

        $this->set([
            'payload' => $payload,
            '_serialize' => 'payload'
        ]);

        $this->response = $this->getResponse()->withStatus($status);
    }

    /**
     * @param mixed $data
     * @param int $status
     */
    protected function failResponse($data, int $status = 400)
    {
        $message = Hash::get($data, 'message', null);
        $errors = Hash::get($data, 'errors', null);
        $this->messageResponse([], false, $status, $message, $errors);
    }
}
