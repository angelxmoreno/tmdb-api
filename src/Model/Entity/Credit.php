<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Credit Entity
 *
 * @property string $id
 * @property int $movie_id
 * @property int $person_id
 * @property int|null $cast_id
 * @property int|null $crew_id
 * @property string $credit_type
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Movie $movie
 * @property \App\Model\Entity\Person $person
 * @property \App\Model\Entity\Cast $cast
 * @property \App\Model\Entity\Crew $crew
 */
class Credit extends Entity
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
        'cast_id' => true,
        'crew_id' => true,
        'credit_type' => true,
        'created' => true,
        'modified' => true,
        'movie' => true,
        'person' => true,
        'cast' => true,
        'crew' => true,
    ];
}
