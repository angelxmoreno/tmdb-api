<?php

namespace App\Model\Table;

use App\Model\Behavior\NullMakerTrait;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Crews Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsTo $Movies
 * @property \App\Model\Table\PeopleTable&\Cake\ORM\Association\BelongsTo $People
 *
 * @method \App\Model\Entity\Crew get($primaryKey, $options = [])
 * @method \App\Model\Entity\Crew newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Crew[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Crew|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Crew saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Crew patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Crew[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Crew findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CrewsTable extends Table
{
    use NullMakerTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('crews');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Movies', [
            'foreignKey' => 'movie_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('People', [
            'foreignKey' => 'person_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('id')
            ->notEmptyString('id', null, 'create');

        $validator
            ->scalar('job')
            ->maxLength('job', 100)
            ->requirePresence('job', 'create')
            ->notEmptyString('job');

        $validator
            ->scalar('department')
            ->maxLength('department', 100)
            ->notEmptyString('department');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['movie_id'], 'Movies'));
        $rules->add($rules->existsIn(['person_id'], 'People'));

        return $rules;
    }


    /**
     * @param Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     */
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        $map = [
            'person_id' => 'id',
            'id' => 'credit_id',
        ];

        foreach ($map as $k => $v) {
            if (is_string($v)) {
                $data[$k] = Hash::get($data, $v, null);
            } elseif (is_callable($v)) {
                $data[$k] = $v($data);
            }

            if (is_string($data[$k])) {
                trim($data[$k]);
            }
        }
        $this->nullifyProps($data);
    }
}
