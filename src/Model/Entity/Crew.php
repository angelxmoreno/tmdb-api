<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Crew Entity
 *
 * @property string $id
 * @property int $movie_id
 * @property int $person_id
 * @property string $job
 * @property string $department
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Movie $movie
 * @property \App\Model\Entity\Person $person
 */
class Crew extends Entity
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
        'person_id' => true,
        'job' => true,
        'department' => true,
        'created' => true,
        'modified' => true,
        'movie' => true,
        'person' => true,
    ];
}
