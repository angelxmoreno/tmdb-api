<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reviewers Model
 *
 * @property \App\Model\Table\ReviewsTable&\Cake\ORM\Association\HasMany $Reviews
 *
 * @method \App\Model\Entity\Reviewer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reviewer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reviewer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reviewer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reviewer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reviewer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reviewer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewersTable extends Table
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

        $this->setTable('reviewers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Reviews', [
            'foreignKey' => 'reviewer_id',
        ]);

        $this->addBehavior('MarshalMapper', [
            'mapper' => [
                'id' => 'username',
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
            ->scalar('id')
            ->maxLength('id', 100)
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('avatar_path')
            ->maxLength('avatar_path', 200)
            ->allowEmptyString('avatar_path');

        $validator
            ->decimal('rating')
            ->greaterThanOrEqual('rating', 0)
            ->allowEmptyString('rating');

        return $validator;
    }
}
