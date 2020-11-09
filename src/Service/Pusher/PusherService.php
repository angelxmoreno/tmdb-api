<?php
declare(strict_types=1);

namespace App\Service\Pusher;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Pusher\Pusher;
use Pusher\PusherException;

/**
 * Class PusherService
 * @package App\Service\Pusher
 */
class PusherService extends Pusher
{
    /**
     * @var self
     */
    protected static $instance = null;

    /**
     * @return PusherService|null
     * @throws PusherException
     */
    public static function instance()
    {
        if (!static::$instance) {
            static::$instance = new self(
                Configure::read('Pusher.key'),
                Configure::read('Pusher.secret'),
                Configure::read('Pusher.app_id'),
                [
                    'cluster' => Configure::read('Pusher.cluster')
                ]
            );
            static::$instance->setLogger(Log::engine('pusher'));
        }
        return static::$instance;
    }

    /**
     * @param string $user_id
     * @param string $event
     * @param array $data
     * @return array|bool
     * @throws PusherException
     */
    public function sendToUserById(string $user_id, string $event, array $data)
    {
        /** @var User $user */
        $user = TableRegistry::getTableLocator()->get('Users')->get($user_id);
        return $this->sendToUser($user, $event, $data);
    }

    /**
     * @param User $user
     * @param string $event
     * @param array $data
     * @return array|bool
     * @throws PusherException
     */
    public function sendToUser(User $user, string $event, array $data)
    {
        $channel = self::userChannel($user->id);
        $this->logger->log('debug', "{$channel}:{$event}");
        return $this->trigger($channel, $event, $data, null, true, false);
    }

    /**
     * @param string $user_id
     * @return string
     */
    public static function userChannel(string $user_id)
    {
        return 'private-user-' . $user_id;
    }

    /**
     * @param string $user_id
     * @param string $channel_name
     * @param string $socket_id
     * @return string
     * @throws PusherException
     */
    public function authUserChannel(string $user_id, string $channel_name, string $socket_id)
    {
        $user_channel = self::userChannel($user_id);
        if ($channel_name !== $user_channel) {
            throw new \InvalidArgumentException('You do not have access to that channel');
        }

        return $this->socket_auth($channel_name, $socket_id);
    }
}
