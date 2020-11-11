<?php
declare(strict_types=1);

namespace App\Model\Behavior;
/**
 * Trait NullMakerTrait
 * @package App\Model\Behavior
 */
trait NullMakerTrait
{
    protected function nullifyProps(\ArrayObject $data)
    {
        $props = $this->newEntity()->getAccessible();
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
