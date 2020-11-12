<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cast Entity
 *
 * @property int $id
 * @property int $movie_id
 * @property int $person_id
 * @property string $name
 * @property string|null $credit_uid
 * @property string|null $cast_uid
 * @property int|null $order
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Movie $movie
 * @property \App\Model\Entity\Person $person
 */
class Cast extends Entity
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
        'movie_id' => true,
        'person_id' => true,
        'name' => true,
        'credit_uid' => true,
        'cast_uid' => true,
        'order' => true,
        'created' => true,
        'modified' => true,
        'movie' => true,
        'person' => true,
    ];
}
