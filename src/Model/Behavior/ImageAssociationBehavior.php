<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;

/**
 * ImageAssociation behavior
 */
class ImageAssociationBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'foreign_model' => null,
        'type' => null,
    ];

    /**
     * Constructor hook method.
     *
     * Implement this method to avoid having to overwrite
     * the constructor and call parent.
     *
     * @param array $config The configuration settings provided to this behavior.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->getTable()->belongsTo($this->getConfig('foreign_model'), [
            'foreignKey' => 'foreign_uid',
        ]);
    }

    /**
     * @param Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return \ArrayObject
     */
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        $data['foreign_model'] = $this->getConfig('foreign_model');
        $data['type'] = $this->getConfig('type');

        if (method_exists($this->getTable(), 'beforeMarshal')) {
            $data = $this->getTable()->beforeMarshal($event, $data, $options);
        }

        return $data;
    }


    /**
     * @param Event $event
     * @param Query $query
     * @param \ArrayObject $options
     * @param $primary
     * @return Query
     *
     * @todo move to ImageAssociation behavior
     */
    public function beforeFind(Event $event, Query $query, \ArrayObject $options, $primary)
    {
        $query->where([
            'foreign_model' => $this->getConfig('foreign_model'),
            'type' => $this->getConfig('type')
        ]);
        return $query;
    }


    /**
     * @param Event $event
     * @param RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(Event $event, RulesChecker $rules)
    {
        $rules = $this->getTable()->buildRules($rules);
        $rules->add($rules->existsIn(['foreign_uid'], $this->getConfig('foreign_model')));

        return $rules;
    }
}
