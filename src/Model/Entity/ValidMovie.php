<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ValidMovie Entity
 *
 * @property int $id
 * @property string $original_title
 * @property float $popularity
 * @property bool $adult
 * @property bool $video
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class ValidMovie extends Entity
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
        'original_title' => true,
        'popularity' => true,
        'adult' => true,
        'video' => true,
        'created' => true,
        'modified' => true,
    ];
}
