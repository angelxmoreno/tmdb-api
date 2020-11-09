<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Table\UsersTable;
use App\Service\Pusher\PusherService;
use Cake\Chronos\Chronos;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Class AuthController
 * @package App\Controller\Api
 *
 * @property UsersTable $Users
 */
class AuthController extends ApiAppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->Auth->allow(['register']);
    }

    /**
     * @return void
     */
    public function check()
    {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            $this->successResponse($user);
        } else {
            $this->failResponse([
                'message' => 'Bad JWT',
            ], 401);
        }
    }

    /**
     * @return void
     */
    public function login()
    {
        $this->request->allowMethod(['post']);

        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            $this->successResponse([
                'user' => $user,
                'jwt' => $this->buildJwt($user['id'])
            ]);
        } else {
            $this->failResponse([
                'message' => 'Email/Password invalid',
            ], 401);
        }
    }

    /**
     * @param string $user_id
     * @return string
     */
    protected function buildJwt(string $user_id)
    {
        $payload = array(
            'user_id' => $user_id,
            'exp' => (int)Chronos::now()->addDays(30)->toUnixString()
        );
        return JWT::encode($payload, Security::getSalt());
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();
        if (!$data) {
            throw new \UnexpectedValueException('Data can not be empty');
        }

        $user = $this->Users->newEntity($data);

        if ($this->Users->save($user)) {
            $this->Auth->setUser($user);
            $this->successResponse([
                'user' => $user,
                'jwt' => $this->buildJwt($user['id'])
            ]);
        } else {
            $this->failResponse([
                'message' => 'Registration failed',
                'errors' => $user->getErrors()
            ], 400);
        }
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function channel()
    {
        $channel_name = $this->request->getData('channel_name');
        $socket_id = $this->request->getData('socket_id');
        if (!$channel_name || !$socket_id) {
            return $this->failResponse([
                'message' => 'Channel and socket must be present'
            ]);
        }

        try {
            $user_id = $this->Auth->user('id');
            $result = PusherService::instance()->authUserChannel($user_id, $channel_name, $socket_id);
            return $this->response->withStringBody($result);
        } catch (\Exception $exception) {
            return $this->failResponse([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
