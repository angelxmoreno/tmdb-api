<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

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
 * @property int $reviews_count
 * @property string $backdrop_path
 * @property string $backdrop_image_url
 * @property string $poster_path
 * @property string $poster_image_url
 * @property string $payload
 * @property \Cake\I18n\FrozenDate|null $released
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Cast[] $casts
 * @property \App\Model\Entity\Crew[] $crews
 * @property \App\Model\Entity\Video[] $videos
 * @property \App\Model\Entity\Genre[] $genres
 * @property \App\Model\Entity\Keyword[] $keywords
 * @property \App\Model\Entity\Company[] $production_companies
 * @property \App\Model\Entity\Image[] $posters
 * @property \App\Model\Entity\Image[] $backdrops
 * @property \App\Model\Entity\Review[] $reviews
 */
class Movie extends Entity
{
    protected $_virtual = ['backdrop_image_url', 'poster_image_url'];
    protected $_hidden = ['payload', 'backdrop_path', 'poster_path'];

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
        'reviews_count' => true,
        'backdrop_path' => true,
        'poster_path' => true,
        'payload' => true,
        'released' => true,
        'created' => true,
        'modified' => true,
        'casts' => true,
        'crews' => true,
        'videos' => true,
        'production_companies' => true,
        'genres' => true,
        'keywords' => true,
        'posters' => true,
        'backdrops' => true,
        'reviews' => true,
    ];

    protected function _getBackdropImageUrl()
    {
        return $this->backdrop_path
            ? Router::url([
                'prefix' => false,
                'plugin' => null,
                'controller' => 'ImageService',
                'action' => 'byMovieId',
                'backdrops',
                $this->id . '.png'
            ], true)
            : null;
    }

    protected function _getPosterImageUrl()
    {
        return $this->poster_path
            ? Router::url([
                'prefix' => false,
                'plugin' => null,
                'controller' => 'ImageService',
                'action' => 'byMovieId',
                'posters',
                $this->id . '.png'
            ], true)
            : null;
    }
}
