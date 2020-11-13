<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property string $id
 * @property int $movie_id
 * @property string $reviewer_id
 * @property string|null $url
 * @property string|null $content
 * @property string|null $iso_639_1
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Movie $movie
 * @property \App\Model\Entity\Reviewer $reviewer
 */
class Review extends Entity
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
        'reviewer_id' => true,
        'url' => true,
        'content' => true,
        'iso_639_1' => true,
        'created' => true,
        'modified' => true,
        'movie' => true,
        'reviewer' => true,
    ];
}
