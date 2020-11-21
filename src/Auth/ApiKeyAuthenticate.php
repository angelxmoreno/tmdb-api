<?php
declare(strict_types=1);

namespace App\Auth;

use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;

/**
 * Class ApiKeyAuthenticate
 * @package App\Auth
 */
class ApiKeyAuthenticate extends \Cake\Auth\BaseAuthenticate
{
    /**
     * Handle unauthenticated access attempt. In implementation valid return values
     * can be:
     *
     * - Null - No action taken, AuthComponent should return appropriate response.
     * - Cake\Http\Response - A response object, which will cause AuthComponent to
     *   simply return that response.
     *
     * @param \Cake\Http\ServerRequest $request A request object.
     * @param \Cake\Http\Response $response A response object.
     * @return \Cake\Http\Response|null|void|bool
     * @throws \Throwable
     */
    public function unauthenticated(ServerRequest $request, Response $response)
    {
        $user = $this->authenticate($request, $response);
        if ($user) return true;
        $payload = [
            'success' => false,
            'status' => 401,
        ];

        return $response
            ->withAddedHeader('Content-Type', 'application/json')
            ->withStatus(401)
            ->withStringBody(json_encode($payload));
    }

    /**
     * @inheritDoc
     * @throws \Throwable
     */
    public function authenticate(ServerRequest $request, Response $response)
    {
        return $this->getUser($request);
    }

    /**
     * Get a user based on information in the request. Primarily used by stateless authentication
     * systems like basic and digest auth.
     *
     * @param \Cake\Http\ServerRequest $request Request object.
     * @return array|false Either false or an array of user information
     * @throws \Throwable
     */
    public function getUser(ServerRequest $request)
    {
        $api_key = $request->getQuery('api_key');
        if (!$api_key) return false;

        try {
            $user = TableRegistry::getTableLocator()->get('Users')->findByApiKey($api_key)->first();

            if (!$user) return false;
            return $user->toArray();
        } catch (\Throwable $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            return false;
        }
    }
}
