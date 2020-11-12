<?php
declare(strict_types=1);


namespace App\Model\Table;

/**
 * Class MovieBackdropsTable
 * @package App\Model\Table
 */
class MovieBackdropsTable extends ImagesTable
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
            'type' => 'backdrops',
        ]);
    }

}
