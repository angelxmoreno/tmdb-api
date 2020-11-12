<?php

namespace App\Model\Table;

use App\Model\Behavior\NullMakerTrait;
use App\Model\Entity\Image;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Images Model
 *
 * @method \App\Model\Entity\Image get($primaryKey, $options = [])
 * @method \App\Model\Entity\Image newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Image|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Image[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Image findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends Table
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
        $this->setEntityClass(Image::class);
        $this->setTable('images');
        $this->setDisplayField('file_path');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('foreign_model')
            ->maxLength('foreign_model', 100)
            ->requirePresence('foreign_model', 'create')
            ->notEmptyString('foreign_model');

        $validator
            ->integer('foreign_uid')
            ->requirePresence('foreign_uid', 'create')
            ->notEmptyString('foreign_uid');

        $validator
            ->scalar('type')
            ->maxLength('type', 100)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('file_path')
            ->maxLength('file_path', 200)
            ->notEmptyFile('file_path');

        $validator
            ->allowEmptyString('height');

        $validator
            ->allowEmptyString('width');

        $validator
            ->allowEmptyString('vote_count');

        $validator
            ->decimal('vote_average')
            ->greaterThanOrEqual('vote_average', 0)
            ->allowEmptyString('vote_average');

        $validator
            ->scalar('iso_639_1')
            ->maxLength('iso_639_1', 20)
            ->allowEmptyString('iso_639_1');

        return $validator;
    }


    /**
     * @param Event $event
     * @param \ArrayObject $data
     * @param \ArrayObject $options
     * @return \ArrayObject
     */
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        if (!isset($data['id'])) {
            /** @var Image|null $found */
            $found = $this->find()->where([
                'foreign_model' => $data['foreign_model'],
                'foreign_uid' => $data['foreign_uid'],
                'type' => $data['type'],
                'file_path' => $data['file_path'],
            ])->first();

            if ($found) {
                $data['id'] = $found->id;
            }
        }

        return $this->nullifyProps($data);
    }
}
