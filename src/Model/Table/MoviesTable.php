<?php

namespace App\Model\Table;

use App\Model\Behavior\PayloadFieldTrait;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Validation\Validator;

/**
 * Movies Model
 *
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

        $this->setTable('movies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Videos', [
            'foreignKey' => 'movie_id',
        ]);

        $this->hasMany('Casts', [
            'foreignKey' => 'movie_id',
        ]);

        $this->hasMany('Crews', [
            'foreignKey' => 'movie_id',
        ]);

        $this->hasMany('Reviews', [
            'foreignKey' => 'movie_id',
        ]);

        $this->hasMany('MoviePosters', [
            'foreignKey' => 'foreign_uid',
            'conditions' => [
                'MoviePosters.type' => 'posters',
                'MoviePosters.foreign_model' => 'movies',
            ],
            'propertyName' => 'posters'
        ]);

        $this->hasMany('MovieBackdrops', [
            'foreignKey' => 'foreign_uid',
            'conditions' => [
                'MovieBackdrops.type' => 'backdrops',
                'MovieBackdrops.foreign_model' => 'movies',
            ],
            'propertyName' => 'backdrops'
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
        $this->belongsToMany('ProductionCompanies', [
            'className' => 'Companies',
            'foreignKey' => 'movie_id',
            'targetForeignKey' => 'company_id',
            'through' => 'MoviesCompanies',
            'conditions' => [
                'MoviesCompanies.type' => MoviesCompaniesTable::TYPE_PRODUCTION
            ]
        ]);
        $this->addBehavior('MarshalMapper', [
            'mapper' => [
                'payload' => function ($data) {
                    return (array)$data;
                },
                'is_adult' => function ($data) {
                    return !!Hash::get($data, 'adult', false);
                },
                'released' => 'release_date',
                'language' => 'original_language',
                'imdb_uid' => 'external_ids.imdb_id',
                'facebook_uid' => 'external_ids.facebook_id',
                'instagram_uid' => 'external_ids.instagram_id',
                'twitter_uid' => 'external_ids.twitter_id',
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
            ->scalar('title')
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('tagline')
            ->maxLength('tagline', 200)
            ->allowEmptyString('tagline');

        $validator
            ->scalar('overview')
            ->maxLength('overview', 4294967295)
            ->allowEmptyString('overview');

        $validator
            ->boolean('is_adult')
            ->notEmptyString('is_adult');

        $validator
            ->decimal('budget')
            ->greaterThanOrEqual('budget', 0)
            ->allowEmptyString('budget');

        $validator
            ->decimal('revenue')
            ->allowEmptyString('revenue');

        $validator
            ->scalar('language')
            ->maxLength('language', 5)
            ->allowEmptyString('language');

        $validator
            ->scalar('homepage')
            ->maxLength('homepage', 200)
            ->allowEmptyString('homepage');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmptyString('status');

        $validator
            ->allowEmptyString('runtime');

        $validator
            ->nonNegativeInteger('vote_count')
            ->allowEmptyString('vote_count');

        $validator
            ->decimal('popularity')
            ->greaterThanOrEqual('popularity', 0)
            ->allowEmptyString('popularity');

        $validator
            ->decimal('vote_average')
            ->greaterThanOrEqual('vote_average', 0)
            ->allowEmptyString('vote_average');

        $validator
            ->scalar('imdb_uid')
            ->maxLength('imdb_uid', 50)
            ->allowEmptyString('imdb_uid');

        $validator
            ->scalar('facebook_uid')
            ->maxLength('facebook_uid', 50)
            ->allowEmptyString('facebook_uid');

        $validator
            ->scalar('instagram_uid')
            ->maxLength('instagram_uid', 50)
            ->allowEmptyString('instagram_uid');

        $validator
            ->scalar('twitter_uid')
            ->maxLength('twitter_uid', 50)
            ->allowEmptyString('twitter_uid');

        $validator
            ->notEmptyString('videos_count');

        $validator
            ->notEmptyString('posters_count');

        $validator
            ->notEmptyString('backdrops_count');

        $validator
            ->notEmptyString('reviews_count');

        $validator
            ->isArray('payload')
            ->requirePresence('payload', 'create')
            ->notEmptyArray('payload');

        $validator
            ->date('released')
            ->allowEmptyDate('released');

        return $validator;
    }
}
