<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Video Entity
 *
 * @property string $id
 * @property int $movie_id
 * @property string $name
 * @property string|null $iso_639_1
 * @property string|null $iso_3166_1
 * @property string|null $site_uid
 * @property string|null $site
 * @property int|null $size
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Movie $movie
 */
class Video extends Entity
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
        'movie_id' => true,
        'name' => true,
        'iso_639_1' => true,
        'iso_3166_1' => true,
        'site_uid' => true,
        'site' => true,
        'size' => true,
        'created' => true,
        'modified' => true,
        'movie' => true,
    ];
}
