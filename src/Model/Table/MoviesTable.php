<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Movies Model
 *
 * @property \App\Model\Table\CreditsTable&\Cake\ORM\Association\HasMany $Credits
 * @property \App\Model\Table\ProductionCompaniesTable&\Cake\ORM\Association\HasMany $ProductionCompanies
 * @property \App\Model\Table\GenresTable&\Cake\ORM\Association\BelongsToMany $Genres
 * @property \App\Model\Table\KeywordsTable&\Cake\ORM\Association\BelongsToMany $Keywords
 *
 * @method \App\Model\Entity\Movie get($primaryKey, $options = [])
 * @method \App\Model\Entity\Movie newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Movie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Movie|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Movie[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Movie findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MoviesTable extends Table
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

        $this->setTable('movies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Credits', [
            'foreignKey' => 'movie_id',
        ]);
        $this->hasMany('ProductionCompanies', [
            'foreignKey' => 'movie_id',
        ]);
        $this->belongsToMany('Genres', [
            'foreignKey' => 'movie_id',
            'targetForeignKey' => 'genre_id',
            'joinTable' => 'movies_genres',
        ]);
        $this->belongsToMany('Keywords', [
            'foreignKey' => 'movie_id',
            'targetForeignKey' => 'keyword_id',
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

        $validator
            ->scalar('payload')
            ->maxLength('payload', 4294967295)
            ->requirePresence('payload', 'create')
            ->notEmptyString('payload');

        return $validator;
    }
}
