<?php
declare(strict_types=1);


namespace App\Model\Table;

use App\Model\Behavior\ImageAssociationBehavior;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;

/**
 * Class MoviePostersTable
 * @package App\Model\Table
 *
 * @mixin ImageAssociationBehavior
 */
class MoviePostersTable extends ImagesTable
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('ImageAssociation', [
            'foreign_model' => 'Movies',
            'type' => 'posters',
        ]);
    }

}
