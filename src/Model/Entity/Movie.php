<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Movie Entity
 *
 * @property int $id
 * @property string $name
 * @property string $payload
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
        'name' => true,
        'payload' => true,
        'created' => true,
        'modified' => true,
        'credits' => true,
        'production_companies' => true,
        'genres' => true,
        'keywords' => true,
    ];
}
