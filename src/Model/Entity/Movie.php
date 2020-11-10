<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Movie Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $tagline
 * @property string|null $overview
 * @property bool $is_adult
 * @property float|null $budget
 * @property float|null $revenue
 * @property string|null $language
 * @property string|null $homepage
 * @property string|null $status
 * @property int|null $runtime
 * @property int|null $vote_count
 * @property float|null $popularity
 * @property float|null $vote_average
 * @property string|null $imdb_uid
 * @property string|null $facebook_uid
 * @property string|null $instagram_uid
 * @property string|null $twitter_uid
 * @property int $videos_count
 * @property int $posters_count
 * @property int $backdrops_count
 * @property string $payload
 * @property \Cake\I18n\FrozenDate|null $released
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Credit[] $credits
 * @property \App\Model\Entity\ProductionCompany[] $production_companies
 * @property \App\Model\Entity\Genre[] $genres
 * @property \App\Model\Entity\Keyword[] $keywords
 */
class Movie extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'title' => true,
        'tagline' => true,
        'overview' => true,
        'is_adult' => true,
        'budget' => true,
        'revenue' => true,
        'language' => true,
        'homepage' => true,
        'status' => true,
        'runtime' => true,
        'vote_count' => true,
        'popularity' => true,
        'vote_average' => true,
        'imdb_uid' => true,
        'facebook_uid' => true,
        'instagram_uid' => true,
        'twitter_uid' => true,
        'videos_count' => true,
        'posters_count' => true,
        'backdrops_count' => true,
        'payload' => true,
        'released' => true,
        'created' => true,
        'modified' => true,
        'credits' => true,
        'production_companies' => true,
        'genres' => true,
        'keywords' => true,
    ];
}
