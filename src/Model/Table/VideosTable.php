<?php

namespace App\Model\Table;

use App\Model\Behavior\NullMakerTrait;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Videos Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsTo $Movies
 *
 * @method \App\Model\Entity\Video get($primaryKey, $options = [])
 * @method \App\Model\Entity\Video newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Video[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Video|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Video saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Video patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Video[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Video findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VideosTable extends Table
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

        $this->setTable('videos');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Movies' => ['videos_count']
        ]);
        $this->belongsTo('Movies', [
            'foreignKey' => 'movie_id',
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
            ->maxLength('id', 100)
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->notEmptyString('name');

        $validator
            ->scalar('iso_639_1')
            ->maxLength('iso_639_1', 20)
            ->allowEmptyString('iso_639_1');

        $validator
            ->scalar('iso_3166_1')
            ->maxLength('iso_3166_1', 20)
            ->allowEmptyString('iso_3166_1');

        $validator
            ->scalar('site_uid')
            ->maxLength('site_uid', 20)
            ->allowEmptyString('site_uid');

        $validator
            ->scalar('site')
            ->maxLength('site', 20)
            ->allowEmptyString('site');

        $validator
            ->allowEmptyString('size');

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

        return $rules;
    }


    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        $map = [
            'site_uid' => 'key',
        ];

        foreach ($map as $k => $v) {
            if (!isset($data[$k]) && is_string($v)) {
                $data[$k] = Hash::get($data, $v, null);
            } elseif (!isset($data[$k]) && is_callable($v)) {
                $data[$k] = $v($data);
            }

            if (is_string($data[$k])) {
                trim($data[$k]);
            }
        }
        $this->nullifyProps($data);
    }
}
