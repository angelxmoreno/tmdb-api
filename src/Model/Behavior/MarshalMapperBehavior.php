<?php

namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\Utility\Hash;

/**
 * MarshalMapper behavior
 */
class MarshalMapperBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'mapper' => [],
    ];


    /**
     * @param Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return \ArrayObject
     */
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        $map = $this->getConfigOrFail('mapper');

        foreach ($map as $k => $v) {
            if (is_string($v)) {
                $data[$k] = Hash::get($data, $v, null);
            } elseif (!isset($data[$k]) && is_callable($v)) {
                $data[$k] = $v($data);
            }

            if (is_string($data[$k])) {
                trim($data[$k]);
            }
        }
        return $data;
    }

}
