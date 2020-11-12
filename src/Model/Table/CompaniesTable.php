<?php

namespace App\Model\Table;

use App\Model\Behavior\PayloadFieldTrait;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsToMany $Movies
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompaniesTable extends Table
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

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Movies', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'movie_id',
            'joinTable' => 'movies_companies',
        ]);
        $this->addBehavior('MarshalMapper', [
            'mapper' => [
                'payload' => function ($data) {
                    return (array)$data;
                },
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
            ->scalar('logo_path')
            ->maxLength('logo_path', 200)
            ->allowEmptyString('logo_path');

        $validator
            ->scalar('origin_country')
            ->maxLength('origin_country', 100)
            ->allowEmptyString('origin_country');

        $validator
            ->isArray('payload')
            ->requirePresence('payload', 'create')
            ->notEmptyArray('payload');

        return $validator;
    }
}
