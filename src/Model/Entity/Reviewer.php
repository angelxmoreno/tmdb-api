<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reviewer Entity
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $avatar_path
 * @property float|null $rating
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Review[] $reviews
 */
class Reviewer extends Entity
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
        'name' => true,
        'avatar_path' => true,
        'rating' => true,
        'created' => true,
        'modified' => true,
        'reviews' => true,
    ];
}
