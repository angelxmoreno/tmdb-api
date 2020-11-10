<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\Database\Schema\TableSchema;

/**
 * Trait PayloadFieldTrait
 * @package App\Model\Behavior
 */
trait PayloadFieldTrait
{
    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->setColumnType('payload', 'json');
        return $schema;
    }
}
