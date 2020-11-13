<?php

namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;

/**
 * NullifyProps behavior
 */
class NullifyPropsBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    /**
     * @param Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return \ArrayObject
     */
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        return $this->nullifyProps($data);
    }

    /**
     * @param \ArrayObject $data
     * @return \ArrayObject
     */
    protected function nullifyProps(\ArrayObject $data)
    {
        $props = $this->getTable()->newEntity()->getAccessible();
        foreach ($props as $name => $writable) {
            if ($writable && isset($data[$name])) {
                if (is_string($data[$name]) && trim($data[$name]) === '') {
                    $data[$name] = null;
                } elseif (is_numeric($data[$name]) && $data[$name] == 0) {
                    $data[$name] = null;
                }
            }
        }

        return $data;
    }
}
