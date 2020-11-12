<?php

namespace App\Model\Table;

use App\Model\Behavior\PayloadFieldTrait;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * People Model
 *
 * @property \App\Model\Table\CastsTable&\Cake\ORM\Association\HasMany $Casts
 * @property \App\Model\Table\CrewsTable&\Cake\ORM\Association\HasMany $Crews
 *
 * @method \App\Model\Entity\Person get($primaryKey, $options = [])
 * @method \App\Model\Entity\Person newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Person[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Person|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Person[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Person findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PeopleTable extends Table
{
    use PayloadFieldTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('people');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Casts', [
            'foreignKey' => 'person_id',
        ]);
        $this->hasMany('Crews', [
            'foreignKey' => 'person_id',
        ]);
        $this->addBehavior('MarshalMapper', [
            'mapper' => [
                'payload' => function ($data) {
                    return (array)$data;
                },
                'is_adult' => function ($data) {
                    return !!Hash::get($data, 'adult', false);
                },
                'gender' => function ($data) {
                    $gender = Hash::get($data, 'gender', null);
                    if ($gender === 1) {
                        return 'f';
                    }
                    if ($gender === 2) {
                        return 'm';
                    }
                    return null;
                },
                'imdb_uid' => 'imdb_id',
            ],
        ]);
        $this->addBehavior('NullifyProps');
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->notEmptyString('name');

        $validator
            ->boolean('is_adult')
            ->allowEmptyString('is_adult');

        $validator
            ->scalar('biography')
            ->maxLength('biography', 4294967295)
            ->allowEmptyString('biography');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 1)
            ->allowEmptyString('gender');

        $validator
            ->scalar('homepage')
            ->maxLength('homepage', 200)
            ->allowEmptyString('homepage');

        $validator
            ->scalar('imdb_uid')
            ->maxLength('imdb_uid', 50)
            ->allowEmptyString('imdb_uid');

        $validator
            ->scalar('known_for_department')
            ->maxLength('known_for_department', 200)
            ->allowEmptyString('known_for_department');

        $validator
            ->scalar('place_of_birth')
            ->maxLength('place_of_birth', 200)
            ->allowEmptyString('place_of_birth');

        $validator
            ->decimal('popularity')
            ->greaterThanOrEqual('popularity', 0)
            ->allowEmptyString('popularity');

        $validator
            ->scalar('profile_path')
            ->maxLength('profile_path', 200)
            ->allowEmptyFile('profile_path');

        $validator
            ->isArray('payload')
            ->requirePresence('payload', 'create')
            ->notEmptyArray('payload');

        $validator
            ->date('birthday')
            ->allowEmptyDate('birthday');

        $validator
            ->date('deathday')
            ->allowEmptyDate('deathday');

        return $validator;
    }
}
