<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use App\Service\Pusher\PusherService;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;

/**
 * Pusher behavior
 */
class PusherBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'getPusherUserIdMethod' => null
    ];

    /**
     * @var PusherService
     */
    protected $service;

    /**
     * @param array $config
     * @throws \Pusher\PusherException
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->service = PusherService::instance();
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @throws \Pusher\PusherException
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        if (!$entity->isDirty('deleted')) {
            $event_name = $this->getTable()->getAlias() . ':';
            $event_name .= $entity->isNew() ? 'create' : 'update';
            $user_id = $this->getPusherUserId($entity);
            if (!$user_id) {
                $msg = 'User Identifier is null for ' . $event_name;
                $prev = new \UnexpectedValueException(json_encode($entity));
                throw new \UnexpectedValueException($msg, 500, $prev);
            }
            $this->service->sendToUserById($user_id, $event_name, $entity->toArray());
        }
    }

    /**
     * @param EntityInterface $entity
     * @return string
     */
    protected function getPusherUserId(EntityInterface $entity)
    {
        $method = $this->getConfig('getPusherUserIdMethod');
        if ($method && method_exists($this->getTable(), $method)) {
            return $this->getTable()->{$method}($entity);
        }
        return $entity->get('user_id');
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @throws \Pusher\PusherException
     */
    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $event_name = $this->getTable()->getAlias() . ':delete';
        $user_id = $this->getPusherUserId($entity);
        $this->service->sendToUserById($user_id, $event_name, $entity->toArray());
    }
}
