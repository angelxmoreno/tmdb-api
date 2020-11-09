<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Keywords Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsToMany $Movies
 *
 * @method \App\Model\Entity\Keyword get($primaryKey, $options = [])
 * @method \App\Model\Entity\Keyword newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Keyword[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Keyword|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Keyword saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Keyword patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Keyword[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Keyword findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class KeywordsTable extends Table
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

        $this->setTable('keywords');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Movies', [
            'foreignKey' => 'keyword_id',
            'targetForeignKey' => 'movie_id',
            'joinTable' => 'movies_keywords',
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
            ->scalar('name')
            ->maxLength('name', 200)
            ->notEmptyString('name');

        return $validator;
    }
}
