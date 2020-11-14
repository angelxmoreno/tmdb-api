<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * ValidMovies Model
 *
 * @method \App\Model\Entity\ValidMovie get($primaryKey, $options = [])
 * @method \App\Model\Entity\ValidMovie newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ValidMovie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ValidMovie|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ValidMovie saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ValidMovie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ValidMovie[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ValidMovie findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ValidMoviesTable extends Table
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

        $this->setTable('valid_movies');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Movies', [
            'foreignKey' => 'id'
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('original_title')
            ->maxLength('original_title', 200)
            ->notEmptyString('original_title');

        $validator
            ->numeric('popularity')
            ->requirePresence('popularity', 'create')
            ->notEmptyString('popularity');

        $validator
            ->boolean('adult')
            ->requirePresence('adult', 'create')
            ->notEmptyString('adult');

        $validator
            ->boolean('video')
            ->requirePresence('video', 'create')
            ->notEmptyString('video');

        return $validator;
    }

    /**
     * @param array $data
     * @return \App\Model\Entity\ValidMovie|false
     */
    public function upsertData(array $data)
    {
        $id = Hash::get($data, 'id', false);
        if (!$id) {
            return false;
        }
        $entity = $this->newEntity($data);
        return $this->save($entity);
    }


    public function findMissingSyncs(int $page = 1, int $limit = 500)
    {
        return $this
            ->find()
            ->notMatching('Movies')
            ->orderDesc('ValidMovies.popularity')
            ->page($page, $limit);
    }
}
